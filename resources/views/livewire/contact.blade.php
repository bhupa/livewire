<div class="container">
    
    <div class="col-md-6">

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Sorry!</strong> invalid input.<br><br>
            <ul style="list-style-type:none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif
    <br>
    <input class="form-control" wire:model="searchTerm" type="text">
    <table class="table table-striped" style="margin-top:20px;">
        <tr>
            <td>NO</td>
            <td>NAME</td>
            <td>EMAIL</td>
            <td>ACTION</td>
        </tr>

        @foreach($contacts as $row)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$row->name ?? Null}}</td>
                <td>{{$row->email  ?? Null}}</td>
                <td>
                    <button wire:click="edit({{$row->id}})" class="btn btn-sm btn-outline-danger py-0">Edit</button> | 
                    <button wire:click="destroy({{$row->id}})" class="btn btn-sm btn-outline-danger py-0">Delete</button>
                </td>
            </tr>
           
        @endforeach
       
    </table>
     {{-- {{ $contacts->links() }} --}}
    </div>

</div> 
 