@extends('ekse/app')

@section('content')

<div class="container p-3">
    <h1 class="text-center"><b>PEMANGGILAN ANTRIAN POLIKLINIK EKSEKUTIF</b></h1>
    <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
</div>
{{-- {{ dd($dokter); }} --}}
<div class="container mb-5">
    <div class="card">
        <a href="#" onclick='window.location.reload(true);' style="text-decoration: none" class="text-black">
            <h5 class="card-header"><b>Lihat Daftar Antrian</b></h5>
        </a>

        <div class="card-body">
            <div class="form-group" id="">
                <select class="form-select form-select mb-3" name="filter" id="filter">
                    <option selected>-- Pilih dokter --</option>
                    @if(count($dokter) > 0)
                    @foreach($dokter as $nama)
                    <option value="{{ $nama['name'] }}">{{ $nama->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <form action="{{ route('displayEkse') }}" method="GET">
                @csrf
                <div class="table-responsive mt-1 table-data tbl-fixed" id="tabel">
                    <table class="table table-bordered align-middle w-100">
                        <thead>
                            <tr class="sticky text-center">
                                <th>No</th>
                                <th width="30%">Nama Dokter</th>
                                <th>Waktu Praktek</th>
                                <th>Jenis Poliklinik</th>
                                <th width="30%">Nama Pasien</th>
                                <th width="">Status</th>
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
                                    {{ $panggil['nama_dokter']}}
                                    <input type="hidden" id="nama_dokter" name="nama_dokter"
                                        value="{{ $panggil['nama_dokter'] }}">
                                </td>
                                <td>
                                    {{ $panggil['waktu_praktek'] }}
                                    <input type="hidden" id="waktu_praktek" name="waktu_praktek"
                                        value="{{ $panggil['waktu_praktek'] }}">
                                </td>
                                <td>
                                    {{ $panggil['jenis_poli'] }}
                                    <input type="hidden" id="jenis_poli" name="jenis_poli"
                                        value="{{ $panggil['jenis_poli'] }}">
                                </td>
                                <td>
                                    {{ $panggil['nama_pasien'] }}
                                    <input type="hidden" id="nama_pasien" name="nama_pasien"
                                        value="{{ $panggil['nama_pasien'] }}">
                                </td>

                                <td>
                                    @if($panggil['status_panggil']=="Menunggu")
                                <td class="text-center">
                                    <b>{{ $panggil['status_panggil'] }}</b>
                                </td>
                                @elseif($panggil['status_panggil']=="Dipanggil")
                                <td class="bg-success text-light text-center">
                                    <b>{{ $panggil['status_panggil'] }}</b>
                                </td>
                                @elseif($panggil['status_panggil']=="Dipending")
                                <td class="bg-warning text-center">
                                    <b>{{ $panggil['status_panggil'] }}</b>
                                </td>
                                @else
                                <td class="bg-danger text-light text-center">
                                    <b>{{ $panggil['status_panggil'] }}</b>
                                </td>
                                @endif

                                <input type="hidden" id="status_panggil" name="status_panggil"
                                    value="{{ $panggil['status_panggil'] }}">
                                </td>
                                {{-- <td class="text-center">
                                    @if($panggil['status_panggil']=="Menunggu")
                                    <b class="text-dark">{{ $panggil['status_panggil'] }}</b>
                                    @elseif($panggil['status_panggil']=="Dipanggil")
                                    <b class="text-success">{{ $panggil['status_panggil'] }}</b>
                                    @elseif($panggil['status_panggil']=="Dipending")
                                    <b class="text-warning">{{ $panggil['status_panggil'] }}</b>
                                    @else
                                    <b class="text-danger">{{ $panggil['status_panggil'] }}</b>
                                    @endif

                                    <input type="hidden" id="status_panggil" name="status_panggil"
                                        value="{{ $panggil['status_panggil'] }}">
                                </td> --}}

                                {{-- <td class="text-center">
                                    <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                                        <a href="" class="btn btn-sm btn-success panggil" data-id="{{ $panggil['id'] }}"
                                            value="Dipanggil" id="panggil">Panggil</a>
                                        <a href="" class="btn btn-sm btn-warning pending" data-id="{{ $panggil['id'] }}"
                                            value="Dipending" id="pending">Pending</a>
                                        <a href="" class="btn btn-sm btn-danger selesai" data-id="{{ $panggil['id'] }}"
                                            value="Selesai" id="selesai">Selesai</a>
                                    </div>
                                </td> --}}
                                <td class="text-center">
                                    <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                                        <a href="{{ route('savepanggilEkse', ['id' => $panggil['id']]) }}"
                                            class="btn btn-sm btn-success">Panggil</a>
                                        <a href="{{ route('savependingEkse', ['id' => $panggil['id']]) }}"
                                            class="btn btn-sm btn-warning">Pending</a>
                                        <a href="{{ route('saveselesaiEkse', ['id' => $panggil['id']]) }}"
                                            class="btn btn-sm btn-danger">Selesai</a>
                                    </div>
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
                url:"{{ route('panggilEkse') }}",
                type:"GET",
                data:{'dokter' : filter},
                success:function(data){
                    var panggil_antrian = data.panggil_antrian;
                    var html = '';
                    if(panggil_antrian.length > 0){
                        for(let i=0; i<panggil_antrian.length; i++){
                            html += '<tr>\
                                    <td>'+(i+1)+'</td>\
                                    <td width="30%">'+panggil_antrian[i]['nama_dokter']+'</td>\
                                    <td>'+panggil_antrian[i]['waktu_praktek']+'</td>\
                                    <td >'+panggil_antrian[i]['jenis_poli']+'</td>\
                                    <td width="30%">'+panggil_antrian[i]['nama_pasien']+'</td>\
                                    <td>\
                                        if('+panggil_antrian[i]['status_panggil']==="Menunggu"+'){\
                                            <td class="text-center">\
                                                <b>'+panggil_antrian[i]['status_panggil']+'</b>\
                                            </td>\
                                        }elseif('+panggil_antrian[i]['status_panggil']==="Dipanggil"+'){\
                                            <td class="bg-success text-light text-center">\
                                                <b>'+panggil_antrian[i]['status_panggil']+'</b>\
                                            </td>\
                                        }elseif('+panggil_antrian[i]['status_panggil']==="Dipending"+'){\
                                            <td class="bg-warning text-center">\
                                                <b>'+panggil_antrian[i]['status_panggil']+'</b>\
                                            </td>\
                                        }else{\
                                            <td class="bg-danger text-light text-center">\
                                                <b>'+panggil_antrian[i]['status_panggil']+'</b>\
                                            </td>}\
                                    </td>\
                                    <td class="text-center">\
                                        <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">\
                                        <a href="savepanggilEkse/' + panggil_antrian[i]['id'] + '" class="btn btn-sm btn-success">Panggil</a>\
                                        <a href="savependingEkse/' + panggil_antrian[i]['id'] + '" class="btn btn-sm btn-warning">Pending</a>\
                                        <a href="saveselesaiEkse/' + panggil_antrian[i]['id'] + '" class="btn btn-sm btn-danger">Selesai</a>\
                                        </div>\
                                    </td>\
                                </tr>';
                        }
                    } else {
                        html += '<tr>\
                                    <td colspan="7" class="bg-danger text-white text-center">Tidak ada antrian</td>\
                                </tr>';
                    }

                    $("#tbody").html(html);
                }
            });
        });
    });
</script>

<script>
    $(function()
    {
        $('#tabel').hide();
        $('#filter').change(function()
            {
                if($('#filter').val() != null) {
                    $('#tabel').show();
                }
            });
    });
</script>

{{-- <script>
    $(document).ready(function(){
        $(document).on('click','.panggil',function(e){
            e.preventDefault();
            let status_panggil = $('#status_panggil').val();
            
            $.ajax({
                url: "{{ route('savepanggilEkse', ['id' => $panggil['id']]) }}",
                method: "GET",
                data: {status_panggil:status_panggil},
                    success: function(res){
                        if(res.status == 'success'){
                            // $('.wkwk').load(location.href+' .wkwk');    
                            $('#wkwk').load(document.URL + ' #wkwk');
                        }
                    }
            });
        })
    });
</script> --}}