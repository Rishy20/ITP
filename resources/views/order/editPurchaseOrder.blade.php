@extends('layouts.main')
@section('content')

<div class="pg-heading">
  <a href="{{ route('purchase.index') }}"><i class="fa fa-arrow-left pg-back"></i></a>
  <div class="pg-title">Create Order</div>
</div>

<div class="section" style="height: 100%;width:100%"> {{-- Start of Section--}}
  <div class="section-title">
      Edit Order Details
      <hr>
  </div>
  <div class="section-content" > {{-- Start of sectionContent--}}
      {{-- Start of Form --}}

    <form method="post" action="{{route('purchase.update',$purchase->id)}}" >
      @csrf
      @method('PATCH')
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label class="sup-label">Vendor Name</label>
                    <select class="form-control sup-select" name="vendorID" required>
                        <option value="" disabled selected hidden>Select a Vendor</option>
                        @foreach($vendor as $v)
                        <option value="{{$v->id}}">{{$v->first_name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="expectedDate" placeholder="Expected Date" required>
                    <label class="float-label">Expected Date</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <textarea class="form-control" name="note" rows="5" placeholder="Enter note here..."></textarea>
                  <label class="float-label">Note</label>
                </div>
                <input type="text" name="total" value="10" hidden>
              </div>
      
              <livewire:select-products :product="$prd" />
              <div class="row submit-row">
                  <div class="col">
                      <input class="btn-submit" type="submit" value="Edit">
                  </div>
              </div>

              
          </form>


        </div> {{-- End  of sectionContent--}}
      </div> {{-- End  of section--}}
      
      <script>

var num = 0;
    var del = 0;
    var arr = [];

    $(document).ready(function() {
        // Search Products
        $("#prdSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".dropdown-menu tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        if($("#allPrd").is(':selected')){
            $("#allProducts").hide();
        }

    });

    function addProduct(id,vid){

        var complex = <?php echo json_encode($prd); ?>;
        complex.forEach(myFunction);
        function myFunction(index,value,array){


            var selectedProducts = document.getElementById("selectedProducts");
            if(array[value]['id'] == id && array[value]['vid'] == vid){
                var row = selectedProducts.insertRow();
                row.className = 'item-table-row';
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var index = num;
                cell1.innerHTML = ++num;
                cell2.innerHTML = array[value]['pcode'];
                cell3.innerHTML = array[value]['name'];
                cell4.innerHTML = array[value]['size'];
                cell5.innerHTML = array[value]['color'];
                cell6.innerHTML = '<i class="fas fa-times cancel" id="remove"></i>';
                cell7.innerHTML = index;
                cell7.className = 'none';
                arr.push([array[value]['id'],array[value]['vid']]);

            }
        }
        var s = JSON.stringify(arr);
        document.cookie = "promotions = "+s;
    }

    $('#selectedProducts').on('click', '#remove', function(e){

        var index = $(this).closest('tr').index();
        var table = document.getElementById("selectedProducts");
        var delrow = table.rows[index].cells[6].innerHTML;
        arr.splice(delrow,1);
        var n = JSON.stringify(arr);
        document.cookie = "promotions = "+n;
        $(this).closest('tr').remove();
        var x = table.rows.length;
        num = 0;
        for(i=1; i<=x;i++){
            table.rows[i].cells[0].innerHTML = ++num;
            table.rows[i].cells[6].innerHTML = num-1;
        }

    });
      </script>

@endsection