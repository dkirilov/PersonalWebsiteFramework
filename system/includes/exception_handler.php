<?php

namespace PWF\System;

class ExceptionHandler{
	public static function handle(Throwable $exception){
		if(DEV_MODE){
			// include template that renders detailed error info
		}else{
			
		}
	}
}