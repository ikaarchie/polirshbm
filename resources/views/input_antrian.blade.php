@extends('app')

@section('content')

<div class="container p-3">
    <h1 class="text-center"><b>INPUT ANTRIAN POLIKLINIK</b></h1>
    <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
</div>

<div class="container mb-3">
    <div class="card">
        <h5 class="card-header"><b>Input Antrian</b></h5>
        <div class="card-body">
            <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container d-md-flex gap-2 justify-content-center bg-white">

                    <select class="form-select form-select-lg" name="pembayaran">
                        <option selected>-- Pilih jenis pembayaran --</option>
                        <option value="Reguler">Reguler</option>
                        <option value="Eksekutif">Eksekutif</option>
                    </select>

                    <select class="form-select form-select-lg" name="namadokter">
                        <option selected>-- Pilih dokter --</option>
                        @foreach ($dokter as $nama)
                        <option value="{{ $nama['name'] }}">{{ $nama->name }}</option>
                        @endforeach
                    </select>

                    <div class="form-floating">
                        <input type="text" name="namapasien" class="form-control form-control-sm" id="floatingInput"
                            placeholder="Masukkan nama pasien" style="height: auto" size="150">
                        <label for="floatingInput">Masukkan nama pasien</label>
                    </div>

                    <button type="submit" class="btn btn-lg btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

            <div class="table-responsive mt-1 table-data tbl-fixed">
                <table class="table table-bordered align-middle w-100">
                    <thead>
                        <tr class="sticky text-center">
                            <th>No</th>
                            <th>Jenis Pembayaran</th>
                            <th width="40%">Nama Dokter</th>
                            <th width="40%">Nama Pasien</th>
                            <th width="">Status</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @if(count($list_antrian) > 0)
                        @php $no = 1; @endphp
                        @foreach($list_antrian as $key => $list)
                        <tr>
                            <td>{{ $list_antrian->firstItem() + $key }}</td>
                            <td>{{ $list['pembayaran']}}</td>
                            <td width="40%">{{ $list['namadokter'] }}</td>
                            <td width="40%">{{ $list['namapasien'] }}</td>
                            <td width="">{{ $list['status_panggil'] }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#filter").on('change', function(){
            var filter = $(this).val();
            $.ajax({
                url:"{{ route('show') }}",
                type:"GET",
                data:{'dokter' : filter},
                success:function(data){
                    var list_antrian = data.list_antrian;
                    var html = '';
                    if(list_antrian.length > 0){
                        for(let i=0; i<list_antrian.length; i++){
                            html += '<tr>\
                                    <td>'+(i+1)+'</td>\
                                    <td>'+list_antrian[i]['pembayaran']+'</td>\
                                    <td width="40%">'+list_antrian[i]['namadokter']+'</td>\
                                    <td width="40%">'+list_antrian[i]['namapasien']+'</td>\
                                    <td width="">'+list_antrian[i]['status_panggil']+'</td>\
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