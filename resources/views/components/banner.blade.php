@if($banner !== null)
<a class="banner" href="{{$banner->link_url}}">
    <div style="background-image: url('{{'storage/' . $banner->img_filename}}');"></div>
</a>
@endif
