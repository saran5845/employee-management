@include('admin.header')

        <table class="table table-bordered custom-style mt-5" style="font-size:25px ">
            <thead>
                <tr>
                    <th width="120px">@sortablelink('name')</th>
                    <th>@sortablelink('email')</th>
                    <th>@sortablelink('department')</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($emp->count())
                    @foreach($emp as $key => $emp_d)
                        <tr>
                            <td>{{ $emp_d->name }}</td>
                            <td>{{ $emp_d->email }}</td>
                            <td>{{ $emp_d->department }}</td>
                            <td><button class="edit-btn btn btn-primary mr-4" type="button" data-toggle="modal" data-target="#edit-model" data-id="{{ $emp_d->id }}">Edit</button><button type="button" class="delete-btn btn btn-danger" data-id="{{ $emp_d->id }}">Delete</button></td>
                        
                          </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {!! $emp->appends(\Request::except('page'))->render() !!}
          
           <!-- Button trigger modal -->
              <!-- Modal -->
              <div class="modal fade" id="edit-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Edit Employee Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                          
                      <form method="POST" id="update-form">
                          @csrf 
                          <div>
                              <x-label for="name"  value="{{ __('Name') }}"/>
                              <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                          </div>

                          <div class="mt-4">
                              <x-label for="email" value="{{ __('Email') }}" />
                              <x-input id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                          </div>

                          <div class="mt-4">
                              <x-label for="department" value="{{ __('Department') }}" />
                              <x-input id="department" class="block mt-1 w-full" type="text" name="department" required autocomplete="department" />
                          </div>
                          
                          <button class="btn btn-primary mt-3" id="submit-button" >Save changes</button>

                        
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>


    </div>
    
    @include('admin.footer')
