<?php

namespace App\Models;

enum Category: string
{
    case SPECIALS = 'Specials';
    case MAIN_COURSE = 'Main course';
    case SNACKS = 'Snacks';
    case DESSERTS = 'Desserts';
    case DRINKS = 'Drinks';
}
