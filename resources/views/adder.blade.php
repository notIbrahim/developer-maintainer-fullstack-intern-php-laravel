@include('layouts.Header')
<body class = "font-sans">
    <div class = "w-screen h-screen bg-none flex justify-evenly">
        <div class = "w-1/3 hidden h-auto max-lg:hidden max-md:hidden max-sm:hidden">1
        </div>
        <div class = "w-1/3 h-screen  bg-white shadow-lg max-md:w-full max-lg:w-full ">
            <nav class = "w-auto h-[100px] bg-slate-800 flex items-center justify-center">
                <h1 class = "text-center text-white">Data Sampah</h1>
            </nav>
            <!-- Center : flex items-center justify-center-->
            <div class = "py-14 bg-white mx-5 h-fit rounded-md">
                <form method="POST" action="{{route('added')}}">
                    @csrf
                    <label class = "text-lg text-justify">Kategori Sampah</label>
                    <select name ="kategori" class="w-full h-[50px] px-4 mb-2 text-lg text-gray-700 
                    placeholder-gray-600 border rounded-xl focus:shadow-outline self-center shadow-md" text>
                        <option value = " " disabled selected hidden>Kategori</option>
                    @foreach($data['materials'] as $key)
                        <option value = {{$key['Kategori']}}>{{$key['Kategori']}}</option>
                    @endforeach
                    </select>
                    <br><br>
                    <label class = "text-lg text-justify">Nama Sampah</label>
                    <input name="names" class="w-full h-[50px] px-4 mb-2 text-lg text-gray-700 
                    placeholder-gray-600 border rounded-xl focus:shadow-outline self-center shadow-md" placeholder="Nama Sampah">
                    <button class =" w-full text-white text-2xl  my-3 py-5 bg-blue-300 rounded-md shadow-lg" type="submit">Tambah
                    </button>
                </form>
            </div> 
        </div>
        <div class = "w-1/3 hidden bg-red-200 max-lg:hidden max-md:hidden max-sm:hidden"> 3</div>
    </div>
</body>