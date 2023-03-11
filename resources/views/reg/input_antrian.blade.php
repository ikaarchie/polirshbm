@extends('reg/app')

@section('content')

<div class="container p-3">
    <h1 class="text-center"><b>INPUT ANTRIAN POLIKLINIK REGULER</b></h1>
    <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
</div>

<div class="container mb-3">
    <div class="card">
        <h5 class="card-header"><b>Input Antrian</b></h5>
        <div class="card-body">
            <form action="{{ route('saveReg') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container d-md-flex gap-2 justify-content-center bg-white">

                    <select class="form-select form-select-lg" name="nama_dokter">
                        <option selected>-- Pilih dokter --</option>
                        @foreach ($dokter as $nama)
                        <option value="{{ $nama['name'] }}">{{ $nama->name }}</option>
                        @endforeach
                    </select>

                    <select class="form-select form-select-lg" name="waktu_praktek">
                        <option selected>-- Pilih waktu praktek --</option>
                        <option value="Pagi">Pagi</option>
                        <option value="Siang">Siang</option>
                        <option value="Malam">Malam</option>
                    </select>

                    <div class="form-floating" style="width: 150%">
                        <input type="text" name="nama_pasien" class="form-control form-control-sm" id="floatingInput"
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
            <h5 class="card-header"><b>Daftar Antrian</b></h5>
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
                            <th width="30%">Nama Dokter</th>
                            <th>Waktu Praktek</th>
                            <th>Jenis Poliklinik</th>
                            <th width="30%">Nama Pasien</th>
                            <th width="">Status</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @if(count($list_antrian) > 0)
                        @php $no = 1; @endphp
                        @foreach($list_antrian as $key => $list)
                        <tr>
                            <td>{{ $list_antrian->firstItem() + $key }}</td>
                            <td width="30%">{{ $list['nama_dokter'] }}</td>
                            <td>{{ $list['waktu_praktek']}}</td>
                            <td>{{ $list['jenis_poli']}}</td>
                            <td width="30%">{{ $list['nama_pasien'] }}</td>
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
                url:"{{ route('showReg') }}",
                type:"GET",
                data:{'dokter' : filter},
                success:function(data){
                    var list_antrian = data.list_antrian;
                    var html = '';
                    if(list_antrian.length > 0){
                        for(let i=0; i<list_antrian.length; i++){
                            html += '<tr>\
                                    <td>'+(i+1)+'</td>\
                                    <td width="30%">'+list_antrian[i]['nama_dokter']+'</td>\
                                    <td>'+list_antrian[i]['waktu_praktek']+'</td>\
                                    <td>'+list_antrian[i]['jenis_poli']+'</td>\
                                    <td width="30%">'+list_antrian[i]['nama_pasien']+'</td>\
                                    <td width="">'+list_antrian[i]['status_panggil']+'</td>\
                                </tr>';
                        }
                    } else {
                        html += '<tr>\
                                    <td colspan="6" class="bg-danger text-white text-center">Tidak ada antrian</td>\
                                </tr>';
                    }

                    $("#tbody").html(html);
                }
            });
        });
    });
</script>