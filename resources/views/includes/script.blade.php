<script src="{{url('frontend/libraries/retina/retina.js')}}"></script>
<script src="{{url('frontend/libraries/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('frontend/libraries/bootstrap/js/bootstrap.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xzoom/1.0.15/xzoom.min.js"></script>

<script src="{{url('frontend/libraries/xzoom/dist/xzoom.min.js')}}"></script>
<script>
  $(document).ready(function() {
    $('.xzoom, .xzoom-gallery').xzoom({
      zoomWidth: 400,
      title: false,
      tint: '#333',
      Xoffset: 10
    });
  });
</script>
