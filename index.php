<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


</head>

<body>


    <div class="container-fluid my-5">
        <h3 class="text-danger text-center">Php Crud With Ajax</h3>
        <div class="row">
            <div class="col-11 mx-auto">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <form action="">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" placeholder="Enter Your Name Here" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" placeholder="Enter Your Email Here" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <label for="">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter Your Password Here" class="form-control">
                            </div>

                            <div class="form-group mt-2">
                                <button type="submit" id="add_user" class="btn btn-info">Add User</button>
                            </div>

                            <div class="form-group mt-2">
                                <div id="msg"></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-12">
                        <table class="table  mt-3 rounded">
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                            <tbody id="data">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {



            //data delete function


            $("#data").on("click",".btn-del",function(){
                console.log("btn is click");
                let id = $(this).attr("data-sid");
                console.log(id);

                del_data = {uid = id}
                $.ajax({
                    url : 'delete.php',
                    method : "post",
                    data : JSON.stringify(del_data),
                    success: function(data){
                        console.log(data);
                    }
                })
            })
            //show data function

            function showdata()
            {
                $.ajax({
                    url: 'retriew.php',
                    method: "GET",
                    dataType : "json",
                    success: function(users)
                    {
                        console.log(users);

                        var tab = $("#data");
                        
                        let alldata = "";
                        for(user in users)
                        {
                            alldata += `
                            
                            <tr>
                                <td> ${users[user].id} </td>
                                <td> ${users[user].name} </td>
                                <td> ${users[user].email} </td>
                                <td> ${users[user].password} </td>
                                <td> 
                                
                                    <a herf='#' class='btn btn-info'>edit</a>
                                    <a herf='#' class='btn btn-danger btn-del' data-sid='${users[user].id}'>Delet</a>
                                </td>

                            </tr>
                            `
                        }
                        tab.html(alldata);
                    }

                })


            }

            showdata();

            //insert data function
            $("#add_user").click(function(e) {
                e.preventDefault();
                let name = $("#name").val();
                let email = $("#email").val();
                let password = $("#password").val();
                // alert(name+" "+email+" "+password);
                let formdata = {
                    name: name,
                    email: email,
                    password: password
                };
                console.log(formdata)

                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: JSON.stringify(formdata),
                    success: function(data) {
                        // console.log(data);

                        var msg = `<div class='alert alert-dark'> ${data} </div>`;
                        $("#msg").html(msg);
                        $("form")[0].reset();


                        setInterval(function() {
                            $("#msg").html("")
                        }, 3000)


                        showdata();
                    }
                })

            });
        })
    </script>

</body>

</html>