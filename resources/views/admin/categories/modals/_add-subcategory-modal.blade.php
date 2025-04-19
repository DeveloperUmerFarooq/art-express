<div class="modal fade" id="Add-SubCategory" tabindex="-1" aria-labelledby="AddSubCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success">
                <h5 class="modal-title fw-semibold text-light" id="AddSubCategoryLabel">
                    <i class="fas fa-layer-group me-2 text-primary"></i> Add Subcategory
                </h5>
                <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('admin.management.catergory.sub.store') }}" method="POST">
                    @csrf

                    {{-- Subcategory Name --}}
                    <div class="mb-3">
                        <label for="subcategory-name" class="form-label fw-semibold">Subcategory Name</label>
                        <input type="text" name="name" id="subcategory-name" class="form-control validate @error('name') is-invalid @enderror" placeholder="e.g. Watercolor Landscape" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Category Selection --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Category</label>
                        <div class="row">
                            @forelse ($categories as $index => $category)
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="category_id"
                                            id="category-{{ $category->id }}"
                                            value="{{ $category->id }}"
                                            {{ $index === 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category-{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted">No categories available.</div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-check-circle me-1"></i> Add Subcategory
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
