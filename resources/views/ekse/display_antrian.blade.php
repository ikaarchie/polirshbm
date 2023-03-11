@extends('ekse/app')

@section('content')

<div class="container p-3">
    <h1 class="text-center"><b>DISPLAY ANTRIAN POLIKLINIK EKSEKUTIF</b></h1>
    <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
</div>

<div class="container" id="appVue">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Dokter</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Waktu Praktek</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in data_pasien">
                <td>@{{ index + 1 }}</td>
                <td>@{{ item.nama_dokter }}</td>
                <td>@{{ item.nama_pasien }}</td>
                <td>@{{ item.waktu_praktek }}</td>
                <td>@{{ item.status_panggil }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var vueDataPasien = new Vue({
        el: "#appVue",
        data: {
            data_pasien: []
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData: function() {
                let url = "{{ route('displayEkse') }}";
                axios.get(url)
                    .then(resp => {
                        this.data_pasien = resp.data.data;
                    })
                    .catch(err => {
                        console.log(err);
                        alert('error');
                    })
            }
        }
    })
</script>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    window.Echo.channel("messages").listen("ServerCreated", (event) => {
        console.log('berhasil');
        vueDataPasien.getData();
    });
</script>
@endsection