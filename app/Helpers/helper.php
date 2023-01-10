<?php

namespace App\Helpers;

function PropertyTypeLabel($record)
{
    if ($record->property_type_id == 1) {
        return '<span class="rounded badge bg-label-slack pull-up">زمین<span>';
    } elseif ($record->property_type_id == 2) {
        return '<span class="badge bg-label-secondary pull-up">ساختمان<span>';
    } else {
        return '<span class="badge bg-label-linkedin pull-up">مجتمع<span>';
    }

}

function UsageTypeLabel($record)
{
    if ($record->usage_type_id == 1) {
        return '<span class="rounded badge bg-label-vimeo pull-up">مسکونی<span>';
    } elseif ($record->usage_type_id == 2) {
        return '<span class="badge bg-label-dribbble pull-up">تجاری<span>';
    } else {
        return '<span class="badge bg-label-twitter pull-up">اداری<span>';
    }}

function PlaceStatusLabel($record)
{
    if ($record->place_status_id == 1) {
        return '<span class="rounded badge bg-label-primary pull-up">جدید<span>';
    } elseif ($record->place_status_id == 2) {
        return '<span class="badge bg-label-info pull-up">اصلاحی<span>';
    } else {
        return '<span class="badge bg-label-success pull-up">تایید شده<span>';
    }}
