<!DOCTYPE html>
<html lang="en">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Laravel 7 PDF Example</title>
    
</head>
<style>

   h2, p{
        text-align: center;
    }
table{
    width:auto;
    margin-left:auto;
    margin-right:auto;
    border-collapse: collapse;

}
table tr td, tr th{
    padding:5px;
}
table tr .last-row td{
    border: 1px solid grey;
    text-align: right;
}
</style>
<body>
    <div class="container mt-5">
        <img src={{$restaurant->image}} alt="" style="width:50px; height:50px; margin-left:48%;">
        <h2 class="text-center ">{{$restaurant->restaurant_name}}  Orders</h2>
        <p> 7 days record <br>
         Date {{\Carbon\Carbon::now()->subDays(7)->toDateString()}}   To  {{\Carbon\carbon::now()->toDateString()}}
         </p>

        <table >
            <thead>
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Order no</th>
                    <th scope="col">Order name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($orders  as $key => $data)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>{{ $data->order_number }}</td>
                    <td>{{ $data->menu_item_name }}</td>
                    <td>{{ $data->order_type }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                @endforeach
                <tr class="last-row" style="text-align:right; padding:5px;">
                    <td colspan="5">
                      <b> Total Orders</b>  
                    </td>
                    <td >
                       <b>{{count($orders)}} </b> 
                    </td>
                </tr>
            </tbody>
        </table>

    </div>


</body>

</html>