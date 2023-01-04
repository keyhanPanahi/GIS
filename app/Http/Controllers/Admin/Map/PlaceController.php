<?php

namespace App\Http\Controllers\Admin\Map;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\Map\Place;
use App\Models\Admin\Map\PropertyType;
use App\Models\Admin\Map\UsageType;
use App\Models\Membership\ExternalServer;
use App\Models\Membership\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use function App\Helpers\PlaceStatusLabel;
use function App\Helpers\PropertyTypeLabel;
use function App\Helpers\UsageTypeLabel;


class PlaceController extends Controller
{
    public function index()
    {
        return view('admin.pages.Map.index');
    }


    public function getPlace(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Place::count();
        $totalRecordswithFilter = Place::where('postal_address', 'like', "%$searchValue%")->count();

        // Fetch records
        $places = Place::query()->select('id', 'owner_fname', 'owner_lname', 'place_status_id', 'point', 'postal_address', 'usage_type_id', 'property_type_id')
            ->orderBy($columnName, $columnSortOrder)
            ->orderBy('id', 'DESC')
            ->where('postal_address', 'like', "%$searchValue%")
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = $places->map(function ($place) {
            return [
                "owner_fname" => $place->owner_fname,
                "owner_lname" => $place->owner_lname,
                "postal_address" => $place->postal_address,
                "place_status_id" => PlaceStatusLabel($place),
                "property_type_id" => PropertyTypeLabel($place),
                "usage_type_id" => UsageTypeLabel($place),
                "action" => Blade::render('admin.pages.Map.table.action', ['id' => $place->id]),
                "select" => Blade::render('components.select', ['id' => $place->id]),
            ];
        });

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    public function create()
    {
        $states = City::select('id', 'name')->where('parent_id', 0)->get();
        $PropertyTypes = PropertyType::select('id', 'name', 'status')->where('status', 1)->get();
        $UsageTypes = UsageType::select('id', 'name')->where('status', 1)->get();
        return view('admin.pages.Map.create', compact('PropertyTypes', 'UsageTypes', 'states'));
    }

    public function store(Request $request)
    {


        if ($request->point) {

            $trimPoint = trim($request->point,'LatLng');
            $city = City::where('id',$request->city_id)->first()->name;
            $state = City::where('id',$request->state_id)->first()->name;
            $address = [$state,$city,$request->address[0],$request->address[1],$request->address[2],$request->address[3],$request->address[4],$request->address[5]];
            $time = Carbon::now()->toDateTimeString();

            $createPlace = [
                'owner_fname' => $request->owner_fname,
                'owner_lname' => $request->owner_lname,
                'owner_nationalcode' => $request->owner_nationalcode,
                'time' => $time,
                'place_status_id' => 1,
                'point' => $trimPoint,
                'postal_code' => $request->postal_code,
                'water_counter_number' => $request->water_counter_number,
                'electric_counter_number' => $request->electric_counter_number,
                'gas_counter_number' => $request->gas_counter_number,
                'usage_type_id' => $request->usage_type_id,
                'property_type_id' => $request->property_type_id,
                'postal_address' => $address,
                'phone' => $request->phone,
                'user_id' => Auth::user()->id,

            ];

            $place = Place::create($createPlace);

            if (isset($request->file)) {

                $FTP = ExternalServer::find(1);
                if ($FTP) {
                    $server = Storage::createFtpDriver(['host' => $FTP->address, 'username' => $FTP->username, 'password' => $FTP->password,'port' => (int)$FTP->port]);
                } else {
                    return back()->with('toast-error', 'فایل بارگذاری نشد.خطا برای سرور رخ داده است.');
                }
                $supportFileTypes = ['jpg', 'png'];
                $files = $request->file;

                foreach ($files as $file) {
                    $fileMimeType = $file->getClientMimeType();
                    $fileSize = $file->getSize();
                    $fileOriginalName = $file->getClientOriginalName();
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = 'places' . DIRECTORY_SEPARATOR . $trimPoint . DIRECTORY_SEPARATOR . 'owner' . DIRECTORY_SEPARATOR . $request->owner_nationalcode . DIRECTORY_SEPARATOR . $filename;

                    if (in_array($fileMimeType, $supportFileTypes)) {
                        //action on image
                        $getFile = Image::make($file)->stream('jpg', 25);
                        //upload image to FTP
                        $result = $server->put($path, $getFile->__toString());
                    } else {
                        //upload another file to FTP
                        $result = $server->put($path, file_get_contents($file->path()));
                    }
                    //insert file info to database
                    if ($result) {
                        $place->files()->create([
                            'name' => $filename,
                            'mime_type' => $fileMimeType,
                            'size' => in_array($fileMimeType, $supportFileTypes) ? $getFile->getSize() : $fileSize,
                            'original_name' => $fileOriginalName,
                            'external_server_id' => 1,
                            'creator_id' => Auth::user()->id,
                        ]);
                    }
                }

            }


            return to_route('admin.place.index')->with('toast-success', 'مکان جدید با موفقیت ایجاد شد.');

        } else {
            return back()->with('toast-error', 'هیچ مکانی بر روی نقشه انتخاب نشده است');

        }
    }


    public function show(Place $place)
    {
        return view('admin.place.show', compact('place'));
    }


    public function edit(Place $place)
    {
        $states = City::select('id', 'name')->where('parent_id', 0)->get();
        $PropertyTypes = PropertyType::select('id', 'name', 'status')->where('status', 1)->get();
        $UsageTypes = UsageType::select('id', 'name')->where('status', 1)->get();
        return view('admin.place.edit', compact('place', 'states', 'UsageTypes', 'PropertyTypes'));
    }

    public function status(Request $request)
    {
        if ($request->ids) {
            Place::whereIn('id', $request->ids)->update(['status' => $request->status]);
            return response()->json(['success' => 'وضعیت موارد انتخابی تغییر یافت.']);
        }

        return response()->json(['error' => 'موردی انتخاب نشده است.']);
    }

    public function destroy(Request $request)
    {
        if ($request->ids) {
            Place::whereIn('id', $request->ids)->delete();
            return response()->json(['success' => 'موارد انتخابی حذف شدند.']);
        }

        return response()->json(['error' => 'موردی انتخاب نشده است.']);
    }


}
