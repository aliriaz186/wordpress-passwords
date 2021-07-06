@extends('layouts.dashboard')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{--    <div>--}}
    <div class="container" style="max-width: 1500px;margin-top: 30px;margin-bottom: 10px">
        @if($errors->any())
            <div class="alert alert-danger">
                <h4 style="color: black;font-size: 14px">{{$errors->first()}}</h4>
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('msg'))
            <div class="alert alert-success" style="margin-bottom: 0px!important;">
                <h4 style="color: black">{{\Illuminate\Support\Facades\Session::get("msg")}}</h4>
            </div>
        @endif
        <h3 style="letter-spacing: 3px;margin-top: 20px" class="mt-4 mb-3">ENTRIES</h3>
        <p style="font-size: 13px;">Below is a list of all the entries.</p>
        <div class="px-5">


           {{-- <label onclick="switchFilters()" style="margin-left: 20px;padding:5px;background:#d3d3d385;border-radius:5px;cursor: pointer;" ><i class="fa fa-filter"></i> Filters</label> --}}
           <div style="padding: 10px;" id="filtersdiv">
                {{-- <input type="text" placeholder="Search by Influencer" id="influencer" > --}}
                <select id="influencer" style="margin-left:10px;padding:5px;width:150px" onchange="getFilteredData()">
                    <option value="" >Search Influencer</option>
                    @foreach ($influencers as $item)
                    <option value="{{$item->influencer}}">{{$item->influencer}}</option>
                    @endforeach
                </select>
                <select  style="margin-left:10px;padding:5px;width:150px" id="product" onchange="getFilteredData()">
                    <option value="" >Search Product</option>
                    @foreach ($products as $item)
                    <option value="{{$item->product}}">{{$item->product}}</option>
                    @endforeach
                </select>
                {{-- <input type="text" placeholder="Search by Product Name" style="margin-left:10px" id="product" onkeydown="searchInfoOnKeyDown()"> --}}
                <select style="margin-left:10px;padding:5px;width:150px" id="category" onchange="getFilteredData()">
                    <option value="" >Select Category</option>
                    @foreach ($categories as $item)
                    <option value="{{$item->product_type}}">{{$item->product_type}}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-dark" onclick="sortDesc()" id="decending" style="padding-top: 2px;padding-bottom:2px">Sort Decending <i class="fas fa-chevron-down"></i></button>
                <button class="btn btn-outline-dark" onclick="sortAsc()" id="ascending" style="display:none;padding-top: 2px;padding-bottom:2px">Sort Ascending <i class="fas fa-chevron-up"></i></button>

                <input type="hidden" id="sort_influencer" value="0">
                <input type="hidden" id="sort_product" value="0">
                <input type="hidden" id="sort_type" value="0">
                <input type="hidden" id="sort_ascending" value="0">

                <span style="margin-left: 5px">
                    <label>SHOW ROWS</label>
                    <select id="length" onchange="getFilteredData()">
                        <option value="15" selected>15</option>
                        <option  value="30">30</option>
                        <option  value="45">45</option>
                        <option  value="60">60</option>
                        <option  value="75">75</option>
                    </select>
                    <span style=";display:none">
                        Showing 1 - <span id="show-filtered">0</span> out of <span id="show-total">0</span> total
                    </span>
                </span>
           </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>LOGO</th>
                    <th>INFLUENCER <i style="color: pointer" class="fa fa-chevron-down" id="sort_influencer1" onclick="setSortInfluencer('sort_influencer')"><i></th>
                        <th>PRODUCT <i style="color: pointer" class="fa fa-chevron-down" id="sort_product1" onclick="setSortProduct('sort_product')"><i></th>
                        <th>TYPE <i style="color: pointer" class="fa fa-chevron-down" id="sort_type1" onclick="setSortType('sort_type')"><i></th>
                    <th>PROMOCODE</th>
                    <th>WORKED</th>
                    <th>NOT WORKED</th>
                    <th>CLICKS</th>
                    <th>INFO</th>
                    <th>OPTIONS</th>
                </tr>
                </thead>
                <tbody id="tbodyId">

                    {{-- @if(count($entries) != 0)
                    @foreach($entries as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src="{{url('show-image')}}/{{$item->id}}" style="height: 30px;
                                width: 30px;
                                border-radius: 12px;"></td>
                            <td>{{$item->influencer}}</td>
                            <td>{{$item->product}}</td>
                            <td>{{$item->product_type}}</td>
                            <td>{{$item->promo_code}}</td>
                            @if ($item->worked != 'N/A')
                            <td style="color: green">{{$item->worked}}%</td>
                            @else
                            <td style="color: green">{{$item->worked}}</td>
                            @endif
                            @if ($item->notwordked != 'N/A')
                            <td style="color: red">{{$item->notwordked}}%</td>
                            @else
                            <td style="color: red">{{$item->notwordked}}</td>
                            @endif
                            <td>{{$item->views}}</td>
                            <td><a href="{{$item->info}}" target="_blank"><i class="fa fa-link"></i></a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="padding: 10px">
                                        <a href="{{url('/edit-entry/'.$item->id)}}" class="btn btn-primary" >EDIT</a>
                                        <a href="{{url('/delete-entry/'.$item->id)}}" style="display: none" id="deletebtn{{$item->id}}">
                                        </a>
                                        <button class="btn btn-danger" onclick="deleteCertificate({{$item->id}})">Delete</button>
                                    </div>
                                  </div>




                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td class="text-center">No Entries Found Yet!</td>
                        <td></td>
                    </tr>
                @endif --}}
                </tbody>
            </table>
        </div>
        <div>
            Showing 1 - <span id="show-filtered2">0</span> out of <span id="show-total2">0</span> total
        </div>

    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" id="resetheading">Modal Heading</h3>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                   <h5>Reset Password</h5>
                    <form action="{{url('set-certificate-password')}}" method="post">
                        @csrf
                        <input type="hidden" id="certificateId" name="certificateId">
                        <div>
                            <input type="text" placeholder="Password" class="form-control" name="password" required>
                        </div><br>
                        <div>
                            <input type="text"  placeholder="ConfirmPassword" class="form-control" name="conpassword" required>
                        </div><br>
                        <div>
                            <button class="btn btn-secondary">SUBMIT</button>
                        </div>
                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        function sortAsc(){
            resetSort();
            document.getElementById('ascending').style.display = 'none';
            document.getElementById('decending').style.display = 'inline';
            document.getElementById('sort_ascending').value = 0;
            getFilteredData();
        }

        function sortDesc(){
            resetSort();
            document.getElementById('ascending').style.display = 'inline';
            document.getElementById('decending').style.display = 'none';
            document.getElementById('sort_ascending').value = 1;
            getFilteredData();
        }

        function setName(fileId, inputId) {
            var files = document.getElementById(fileId).files;
            if (files.length > 0) {
                document.getElementById(inputId).value = files[0].name;
            }
        }

        function deleteCertificate(id) {
            if(confirm('Confirm delete this entry?')){
                document.getElementById('deletebtn'+ id).click();
            }
        }

        function resetModal(id, name) {
            document.getElementById('resetheading').innerText = name + " (ref : " + id + ")";
            document.getElementById('certificateId').value = id;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
// Prepare the preview for profile picture
            $("#photo").change(function () {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photopreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


<script>
    $(document).ready(function(){
        getFilteredData();
        $('#influencer').select2();
        $('#product').select2();
        $('#category').select2();


    });
    let switchF = false;
    let influencerSort = 0;
    let productSort = 0;
    let typeSort = 0;
    function setSortInfluencer(type){
        if(influencerSort === 0){
            resetSort();
            document.getElementById(type).value = 1;
            document.getElementById('sort_influencer' + '1').classList.remove('fa-chevron-down');
            document.getElementById(type + '1').classList.add('fa-chevron-up');
            influencerSort = 1;
        }else{
            resetSort();
            document.getElementById(type).value = 0;
            influencerSort = 0;
        }

        getFilteredData();

    }

    function setSortProduct(type){
        if(productSort === 0){
            resetSort();
            document.getElementById(type).value = 1;
            document.getElementById('sort_product' + '1').classList.remove('fa-chevron-down');
            document.getElementById(type + '1').classList.add('fa-chevron-up');
            productSort = 1;
        }else{
            resetSort();
            document.getElementById(type).value = 0;
            productSort = 0;
        }

        getFilteredData();

    }

    function setSortType(type){
        if(typeSort === 0){
            resetSort();
            document.getElementById(type).value = 1;

            document.getElementById('sort_type' + '1').classList.remove('fa-chevron-down');
            document.getElementById(type + '1').classList.add('fa-chevron-up');
            typeSort = 1;
        }else{
            resetSort();
            document.getElementById(type).value = 0;
            typeSort = 0;
        }

        getFilteredData();

    }

    function resetSort(){
        document.getElementById('sort_influencer' + '1').classList.remove('fa-chevron-up');
        document.getElementById('sort_product' + '1').classList.remove('fa-chevron-up');
        document.getElementById('sort_type' + '1').classList.remove('fa-chevron-up');
        document.getElementById('sort_influencer' + '1').classList.remove('fa-chevron-down');
        document.getElementById('sort_product' + '1').classList.remove('fa-chevron-down');
        document.getElementById('sort_type' + '1').classList.remove('fa-chevron-down');

        document.getElementById('sort_influencer' + '1').classList.add('fa-chevron-down');
        document.getElementById('sort_product' + '1').classList.add('fa-chevron-down');
        document.getElementById('sort_type' + '1').classList.add('fa-chevron-down');

        document.getElementById('sort_influencer').value = 0;
        document.getElementById('sort_product').value = 0;
        document.getElementById('sort_type').value = 0;

        influencerSort = 0;
        productSort = 0;
        typeSort = 0;
    }

    function switchFilters(){
        if(switchF == false){
            document.getElementById('filtersdiv').style.display = 'block';
            switchF = true;
        }
        else if(switchF == true){
            document.getElementById('filtersdiv').style.display = 'none';
            switchF = false;
        }

    }
    let typingTimer;
    function searchInfoOnKeyDown(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            getFilteredData();
        }, 1000);
        return true;
    }

    function getFilteredData(){
        let influencer = document.getElementById('influencer').value;
        let product = document.getElementById('product').value;
        let category = document.getElementById('category').value;
        let length = document.getElementById('length').value;
        let sort_influencer = document.getElementById('sort_influencer').value;
        let sort_product = document.getElementById('sort_product').value;
        let sort_type = document.getElementById('sort_type').value;
        let sort_ascending = document.getElementById('sort_ascending').value;

        let formData = new FormData();
        formData.append('influencer', influencer);
        formData.append('product', product);
        formData.append('category', category);
        formData.append('length', length);
        formData.append('sort_influencer', sort_influencer);
        formData.append('sort_product', sort_product);
        formData.append('sort_type', sort_type);
        formData.append('sort_ascending', sort_ascending);
        formData.append("_token", "{{ csrf_token() }}");
        document.getElementById('tbodyId').innerHTML = 'Filtering data...';
        $.ajax({
            url: `{{env('APP_URL')}}/search-entries-by-admin`,
            type: 'POST',
            dataType: "JSON",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {

                if (result.status === true) {
                   console.log(result.data);
                   showData(result.data);
                   document.getElementById('show-filtered').innerText = result.data.length;
                   document.getElementById('show-total').innerText = result.entriesCount;
                   document.getElementById('show-filtered2').innerText = result.data.length;
                       document.getElementById('show-total2').innerText = result.entriesCount;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message,
                    });
                }
            },
            error: function (data) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "server Error",
                });
            }
        });
    }

    function showData(entries){
        document.getElementById('tbodyId').innerHTML = '';
        for(let i=0;i<entries.length;i++){
            let tr = document.createElement('tr');
            let td1 = document.createElement('td');
            let td2 = document.createElement('td');
            let td3 = document.createElement('td');
            let td4 = document.createElement('td');
            let td5 = document.createElement('td');
            let td6 = document.createElement('td');
            let td7 = document.createElement('td');
            let td8 = document.createElement('td');
            let td9 = document.createElement('td');
            let td10 = document.createElement('td');
            let tdoptions = document.createElement('td');
            td1.innerText = i + 1;
            let img = document.createElement('img');
            img.src = `{{url('show-image')}}` + '/' + entries[i].id;
            img.style = "height: 30px;width: 30px;border-radius: 12px;";

            let info = document.createElement('a');
            info.setAttribute('href', entries[i].info);
            info.setAttribute('target', '_blank');
            let linkIcon = document.createElement('i');
            linkIcon.classList.add('fa', 'fa-link');
            linkIcon.style.fontSize = '20px';
            info.appendChild(linkIcon);
            td2.appendChild(img);
            td3.innerText = entries[i].influencer;
            td4.innerText = entries[i].product;
            td5.innerText = entries[i].product_type;
            td6.setAttribute('id', 'promo_code' + entries[i].id)
            td6.innerHTML = entries[i].promo_code;
            if(entries[i].worked !== 'N/A'){
                let spanworked = document.createElement('span');
                spanworked.style.color = 'green';
                spanworked.innerHTML = entries[i].worked + '%';
                td7.appendChild(spanworked);
            }else{
                let spanworked = document.createElement('span');
                spanworked.style.color = 'green';
                spanworked.innerHTML = entries[i].worked;
                td7.appendChild(spanworked);
            }
            if(entries[i].notwordked !== 'N/A'){
                let spannotworked = document.createElement('span');
                spannotworked.style.color = 'red';
                spannotworked.innerHTML =  entries[i].notwordked + '%';
                td8.appendChild(spannotworked);
            }else{
                let spannotworked = document.createElement('span');
                spannotworked.style.color = 'red';
                spannotworked.innerHTML =  entries[i].notwordked;
                td8.appendChild(spannotworked);
            }

            td9.innerHTML = entries[i].views;
            td10.appendChild(info);

            let editbtn = document.createElement('a');
            editbtn.classList.add('btn', 'btn-primary');
            editbtn.setAttribute('href', `{{url('/edit-entry/')}}` + '/' + entries[i].id);
            editbtn.innerText = 'EDIT';

            let deleteLink = document.createElement('a');
            deleteLink.setAttribute('href', `{{url('/delete-entry/')}}` + '/' + entries[i].id);
            deleteLink.style.display = 'none';
            deleteLink.setAttribute('id', 'deletebtn' + entries[i].id)
            let deleteButton = document.createElement('button');
            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.innerText = 'DELETE';
            deleteButton.style.marginLeft = '5px';
            deleteButton.addEventListener('click', function() {
                deleteCertificate(entries[i].id);
            });
            tdoptions.appendChild(editbtn);
            tdoptions.appendChild(deleteLink);
            tdoptions.appendChild(deleteButton);


            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            tr.appendChild(td6);
            // tr.appendChild(tdoptions);
            tr.appendChild(td7);
            tr.appendChild(td8);
            tr.appendChild(td9);
            tr.appendChild(td10);
            tr.appendChild(tdoptions);
            document.getElementById('tbodyId').appendChild(tr);
        }
    }

    function getCodeApi(id){
        let formData = new FormData();
        formData.append('id', id);
        formData.append('useragent',  navigator.userAgent);

        formData.append("_token", "{{ csrf_token() }}");
        $.ajax({
            url: `{{env('APP_URL')}}/code-get`,
            type: 'POST',
            dataType: "JSON",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {

                if (result.status === true) {
                //    console.log(result.data);


                } else {

                }
            },
            error: function (data) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "server Error",
                });
            }
        });
    }

    function likebtnFunc(id){

        let formData = new FormData();
        formData.append('status', 'liked');
        formData.append('id', id);
        formData.append('useragent',  navigator.userAgent);
        formData.append("_token", "{{ csrf_token() }}");
        $.ajax({
            url: `{{env('APP_URL')}}/like-btn`,
            type: 'POST',
            dataType: "JSON",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if(result === true){
                    swal("Success", "Liked");
                }else{
                    swal("Error", "You Already gave the feedbackfor this entry.");
                }

                getFilteredData();
            },
            error: function (data) {


            }
        });
    }

    function unlikebtnFunc(id){


        let formData = new FormData();
        formData.append('status', 'unliked');
        formData.append('id', id);
        formData.append('useragent',  navigator.userAgent);
        formData.append("_token", "{{ csrf_token() }}");
        $.ajax({
            url: `{{env('APP_URL')}}/unlike-btn`,
            type: 'POST',
            dataType: "JSON",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if(result === true){
                    swal("Success", "Liked");
                }else{
                    swal("Error", "You Already gave the feedbackfor this entry.");
                }
                getFilteredData();

            },
            error: function (data) {


            }
        });
    }

</script>
@endsection
