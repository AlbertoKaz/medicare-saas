<?php

namespace App\Enums;

enum ClinicalNoteVisibility:string
{
    case Doctor='doctor';

    case Owner='owner';
}
