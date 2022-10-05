@php
    $currentUrl = url()->full();
    $tempArray = explode('/', $currentUrl);
    $check = in_array('admin', $tempArray);
    $extends = '';
    $include = '';
    if($check)
    {      
        // if(auth()->check())
        // {
        //     $extends = 'admin.main';
        //     $include = 'errors.admin';
        // }
        // else 
        // {
        //     return;
        // }

        $extends = 'admin.main';
        $include = 'errors.admin';
        
    }
    else{
        $extends = 'client.main';
        $include = 'errors.client';
    }
@endphp

@extends($extends)

@section("content")
   @include($include)
@endsection
