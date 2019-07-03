
<div class="container">
    </div>
        <div class="container">
            <button onclick="myFunction()" class="btn btn-primary">اطبع</button>
            <table width="90%" style="direction:rtl; margin-left: :200px;" class="text-center">
              <tr>
                <td><h3> خضري مصر</h3></td>
                <td>
                  <h3> اسم العميل <span>{{$order[0]->client_name}}</span> <br>
                  العنوان  :
                  <!-- <span>{{$order[0]->vaillage}} <br>
                              </span><span>{{$order[0]->area}} <br>
                              </span><span>{{$order[0]->gove}}</span>  <br> -->
                            </span><span>{{$order[0]->address}}</span>  <br>
                 رقم التليفون  : <span>{{$order[0]->client_telephone}}</span>
               </h3>
              </td>
                <td><h3> خضري مصر</h3></td>
              </tr>
              @for($i=0;$i<count($products);$i++)
              <tr>
                <td><h3>{{$products[$i]['name']}}</h3></td>
                <td><h3> الكميه : {{$products[$i]['quentety']}}</h3></td>
                <td><h3> السعر  : {{$products[$i]['price']}}</h3></td>
              </tr>

              @endfor
              <tr>
                <td colspan="2"><h1>التكلفه شامله الشحن تساوي </h1></td>
                <td><h1> {{$order[0]->totalprice}}</h1></td>
              </tr>
            </table>

        </div>
</div>
    <script>
        function myFunction() {
            window.print();
        }
    </script>
