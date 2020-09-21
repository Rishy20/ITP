<div>
    <div class="pg-heading">

        <div class="pg-title">All Sales</div>
        {{-- <input type="text" class="daterange"  id="daterange" name="daterange"   /> --}}
      <span  id="daterange">
        <input type="date" class="form-control daterange" id="end"  name="end" >
        <span class="dash">-</span>
        <input type="date" class="form-control daterange" id="start" name="start" >
    </span>

        <div class="period-selector">
            <select class="custom-select p-select" id="pSelect"   id="typeSel">
                <option value="1">Today</option>
                <option value="2">Last 2 days</option>
                <option value="7">Last 7 days</option>
                <option value="14">Last 14 days</option>
                <option value="30">Last month</option>
                <option value="range" id="date">Date Range</option>
            </select>

        </div>
    </div>

    <div class="section"> {{-- Start of Section--}}

        <div class="section-content"> {{-- Start of sectionContent--}}

            <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
                {{-- <div class="add-btn">
                    <a href="{{ route('user.create') }}">Add User</a>
                </div> --}}
                <thead class="table-head">
                    <tr>
                        <th>Sale Id</th>
                        <th>Staff Name</th>
                        <th>Customer Name</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale as $s)


                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->fname.' '.$s->lname }}</td>
                        <td>{{ $s->firstname.' '.$s->lastname }}</td>
                        <td>{{ $s->amount }}</td>
                        <td>{{ $s->discount }}</td>
                        <td>{{ $s->updated_at }}</td>

                        <td class="action-icon">
                            <a href="{{ route('sale.edit',$s->id) }}"><i class="fas fa-pen"></i></a>
                            <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                            <form method="POST" class="dlt-form" action="{{ route('sale.destroy',$s->id) }}">
                                @method('DELETE')
                                @csrf

                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div> {{-- End  of sectionContent--}}
    </div> {{-- End  of section--}}

</div>
