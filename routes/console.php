<?php
use Illuminate\Support\Facades\Schedule;

Schedule::command('auctions:handle')->everyMinute();
