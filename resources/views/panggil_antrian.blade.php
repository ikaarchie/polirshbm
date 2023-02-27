@extends('app')

@section('content')

<div class="container p-3">
    <h1 class="text-center"><b>PEMANGGILAN ANTRIAN POLIKLINIK</b></h1>
    <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
</div>
{{-- {{ dd($dokter); }} --}}
<div class="container mb-5">
    <div class="card">
        <a href="#" onclick='window.location.reload(true);' style="text-decoration: none" class="text-black">
            <h5 class="card-header"><b>Lihat Daftar Antrian</b></h5>
        </a>

        <div class="card-body">
            <select class="form-select form-select mb-3" name="filter" id="filter">
                <option selected>-- Pilih dokter --</option>
                @if(count($dokter) > 0)
                @foreach($dokter as $nama)
                <option value="{{ $nama['name'] }}">{{ $nama->name }}</option>
                @endforeach
                @endif
            </select>

            <form action="{{ route('display') }}" method="GET">
                {{-- <form action="{{ route('savepanggil') }}" method="POST"> --}}
                    @csrf
                    <div class="table-responsive mt-1 table-data tbl-fixed">
                        <table class="table table-bordered align-middle w-100">
                            <thead>
                                <tr class="sticky text-center">
                                    <th>No</th>
                                    <th>Jenis Pembayaran</th>
                                    <th width="35%">Nama Dokter</th>
                                    <th width="35%">Nama Pasien</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @if(count($panggil_antrian) > 0)
                                @php $no = 1; @endphp
                                @foreach($panggil_antrian as $key => $panggil)
                                <tr>
                                    <input type="hidden" id="id" name="id" value="{{ $panggil['id'] }}">
                                    <td>{{ $panggil_antrian->firstItem() + $key }}</td>
                                    <td>
                                        {{ $panggil['pembayaran']}}
                                        <input type="hidden" id="pembayaran" name="pembayaran"
                                            value="{{ $panggil['pembayaran'] }}">
                                    </td>
                                    <td width="35%">
                                        {{ $panggil['namadokter'] }}
                                        <input type="hidden" id="namadokter" name="namadokter"
                                            value="{{ $panggil['namadokter'] }}">
                                    </td>
                                    <td width="35%">
                                        {{ $panggil['namapasien'] }}
                                        <input type="hidden" id="namapasien" name="namapasien"
                                            value="{{ $panggil['namapasien'] }}">
                                    </td>
                                    <td class="text-center">
                                        {{-- <a href="#" id="panggil" class="btn btn-sm btn-success">Panggil</a> --}}
                                        {{-- <button type="submit" class="btn btn-sm btn-success">Panggil</button> --}}
                                        <button type="submit" class="btn btn-sm btn-success">Panggil</button>
                                        <button type="" class="btn btn-sm btn-primary">Panggil Ulang</button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#filter").on('change', function(){
            var filter = $(this).val();
            $.ajax({
                url:"{{ route('panggil') }}",
                type:"GET",
                data:{'dokter' : filter},
                success:function(data){
                    var panggil_antrian = data.panggil_antrian;
                    var html = '';
                    if(panggil_antrian.length > 0){
                        for(let i=0; i<panggil_antrian.length; i++){
                            html += '<tr>\
                                    <td>'+(i+1)+'</td>\
                                    <td>'+panggil_antrian[i]['pembayaran']+'</td>\
                                    <td width="35%">'+panggil_antrian[i]['namadokter']+'</td>\
                                    <td width="35%">'+panggil_antrian[i]['namapasien']+'</td>\
                                    <td class="text-center">\
                                        <button type="submit" class="btn btn-sm btn-success">'+"Panggil"+'</button>\
                                        <button type="submit" class="btn btn-sm btn-primary">'+"Panggil Ulang"+'</button>\
                                    </td>\
                                </tr>';
                        }
                    } else {
                        html += '<tr>\
                                    <td colspan="5" class="bg-danger text-white text-center">Tidak ada antrian</td>\
                                </tr>';
                    }

                    $("#tbody").html(html);
                }
            });
        });
    });
</script>