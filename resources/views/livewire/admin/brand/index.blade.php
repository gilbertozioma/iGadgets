<div>

    {{-- Include the modal form for adding or updating a brand --}}
    @include('livewire.admin.brand.modal-form')

    <div class="row">
        <div class="col-md-12">
            {{-- Display a success message if there is one in the session --}}
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>
                        Brands List
                        {{-- Button to open the "Add Brand" modal --}}
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary btn-sm float-end">Add Brands</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through the list of brands and display the information in the table --}}
                            @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    {{-- Display the associated category name, if any --}}
                                    @if($brand->category)
                                        {{ $brand->category->name }}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $brand->slug }}</td>
                                <td>{{ $brand->status == '1' ? 'hidden':'visible' }}</td>
                                <td>
                                    {{-- Buttons to edit and delete the brand, which will open respective modals --}}
                                    <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="text-light btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#" wire:click="deleteBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="text-light btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            {{-- If there are no brands, display a message --}}
                            <tr>
                                <td colspan="5">No Brands Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- Display pagination links for the brands --}}
                    <div>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Add a script to close the modals when the "close-modal" event is emitted --}}
@push('script')
<script>
    window.addEventListener('close-modal', event => {

        // Close the addBrandModal, updateBrandModal, and deleteBrandModal
        $('#addBrandModal').modal('hide');
        $('#updateBrandModal').modal('hide');
        $('#deleteBrandModal').modal('hide');
    });
</script>
@endpush
