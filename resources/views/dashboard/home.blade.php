@extends('layouts.dashboard')

@section('content')
    <section class="sevices-area" style="margin-top: 30px">

        <div class="container" style="padding: 20px">
            <h3>Promo Code   Stats</h3>
           <table class="table">
               <thead>
                   <tr>
                       <th>
                           #
                       </th>
                       <th>
                        Influencer
                    </th>
                    <th>
                        Product
                    </th>
                    <th>
                        Promo Code Viewed
                    </th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($tempEntries as $key => $item)
                   <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$item->influencer}}</td>
                       <td>{{$item->product}}</td>
                       <td>{{$item->views}} times</td>
                </tr>
                   @endforeach

               </tbody>
           </table>
        </div>
    </section>
@endsection
