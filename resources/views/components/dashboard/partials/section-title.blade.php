@props(['title','width' =>'500px','background'=>'gray'])
<div style="position: relative; width:{{$width}};height:60px;">
    <span
        style="position: absolute;width:100%; height: 3px;background:{{$background}};display:block;transform:translateY(-50%);top:70%;"></span>
    <span
        style="position: absolute; display:block; margin-top:15px; font-size:18px; color:#666;text-wrap:nowrap; padding-left: 15px;padding-right: 15px;font-weight:bold;transform:translate(-50%,-50%);top:40%;left:50%;background: #f4f6f9;">
        {{ $title }}</span>
</div>
