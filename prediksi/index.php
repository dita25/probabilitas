<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<div class="container">
    <h1 class="text-center">STATUS MAHASISWA</h1>
    <div class="row g-3">
        <div class="col"> <!--mengganti posisi form-->
            <div class="card">
                <div class="card-header bg-info text-light">
                    INPUT DATA MAHASISWA
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="input-group mb-5">
                            <label for="NIM" class="input-group-text">NIM</label>
                            <input name="nim" type="text" class="form-control" id="NIM">
                        </div>
                        <div class="input-group mb-5">
                            <label class="input-group-text" for="gender">GENDER</label>
                            <select name="gender" class="form-select" id="nim">
                                <option selected>--PILIH--</option>
                                <option value="0">LAKI-LAKI</option>
                                <option value="1">PEREMPUAN</option>
                            </select>
                        </div>
                        <div class="input-group mb-5">
                            <label class="input-group-text" for="course">COURSE</label>
                            <select name="course" class="form-select" id="nim">
                                <option selected>--PILIH--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="input-group mb-5" name="daytime">
                            <label class="input-group-text" for="daytime">DAYTIME</label>
                            <select name="daytime" class="form-select" id="daytime">
                                <option selected>--PILIH--</option>
                                <option value="0">PAGI</option>
                                <option value="1">MALAM</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="age">AGE</label>
                            <select name="age" class="form-select" id="age">
                                <option selected>--PILIH--</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                            </select>
                        </div>
                        <div class="mb-5 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary" name="input">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </form>
                </div>
                <div class="card-footer bg-info">

                </div>
            </div>
        </div>

        <div class="col-md-3"> <!--mengganti posisi form-->
            <div class="card mt-3">
                <div class="card-header bg-info text-light">
                    STATUS MAHASISWA
                </div>
                <form action="" method="post">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>NIM</th>
                                    <th>:</th>
                                    <th>
                                        <?php
                                        if (isset($_POST['input'])) {
                                            $nim = $_POST['nim'];
                                            echo "$nim";
                                        }
                                        ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>GENDER</th>
                                    <th>:</th>
                                    <th>
                                        <?php
                                        if (isset($_POST['input'])) {
                                            $gender = $_POST['gender'];
                                            echo "$gender";
                                        }
                                        ?></th>
                                </tr>
                                <tr>
                                    <th>COURSE</th>
                                    <th>:</th>
                                    <th>
                                        <?php
                                        if (isset($_POST['input'])) {
                                            $course = $_POST['course'];
                                            echo "$course";
                                        }
                                        ?></th>
                                </tr>
                                <tr>
                                    <th>DAYTIME</th>
                                    <th>:</th>
                                    <th>
                                        <?php
                                        if (isset($_POST['input'])) {
                                            $daytime = $_POST['daytime'];
                                            echo "$daytime";
                                        }
                                        ?>

                                    </th>
                                </tr>
                                <tr>
                                    <th>AGE</th>
                                    <th>:</th>
                                    <th> <?php
                                            if (isset($_POST['input'])) {
                                                $age = $_POST['age'];
                                                echo "$age";
                                            }
                                            ?></th>
                                </tr>
                                <tr>
                                    <th>STATUS</th>
                                    <th>:</th>
                                    <th class="table-success">GRADUATE</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-info">

                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<!--INPUT DATA-->


<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto"> <!--mengganti posisi form-->
            <div class="card mt-4">
                <div class="card-header bg-info text-light">
                    HASIL DATA MAHASISWA
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIM</th>
                                <th scope="col">GENDER</th>
                                <th scope="col">COURSE</th>
                                <th scope="col">DAYTIME</th>
                                <th scope="col">AGE</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>211212121</td>
                                <td>1</td>
                                <td>9</td>
                                <td>2</td>
                                <td>24</td>
                                <td>GRADUATE</td>
                                <td>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <a href="" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>232323323</td>
                                <td>1</td>
                                <td>13</td>
                                <td>1</td>
                                <td>29</td>
                                <td>ENROLL</td>
                                <td>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <a href="" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>31313131</td>
                                <td>0</td>
                                <td>16</td>
                                <td>1</td>
                                <td>25</td>
                                <td>DROPOUT</td>
                                <td>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <a href="" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-info">

                </div>
            </div>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>