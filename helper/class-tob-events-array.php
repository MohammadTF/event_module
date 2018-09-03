<?php
namespace Tob_Events\Helper;

class Tob_Events_Array
{
    public static function is_assoc($arr)
	{
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
	
}