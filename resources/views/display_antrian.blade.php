@extends('app')

@section('content')

<div class="container p-3">
    <h1 class="text-center"><b>DISPLAY ANTRIAN POLIKLINIK</b></h1>
    <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
</div>

<div class="container">
    {{ dd($display) }}

    <h1><span id="responsecontainer"></span></h1>
</div>

<script>
    $(document).ready(function() {
 	 $("#responsecontainer").load("respon/respon_transaksi.php");
   var refreshId = setInterval(function() {
      $("#responsecontainer").load('respon/respon_transaksi.php');
   }, 2000);
   $.ajaxSetup({ cache: false });
});
</script>