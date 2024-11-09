<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create data-siswa</title>
</head>
<body>
    <form action="{{route('kirim')}}" method="post">
        @csrf
        <div class="form-group">
            <label>nama siswa</label>
            <input type="text" name="nama">
        </div>
        <div class="form-group">
            <label>kelas</label>
            <select name="kelas">
                <option value="IX B">IX A</option>
                <option value="IX B">IX B</option>
        </div>
        <div class="form-group" >
            <label>email siswa</label>
            <input type="email" name="email">
        </div>
        <div class="form-button">
            <button type="submit">Tambah Data</button>
        </div>
    </form>
</body>
</html>