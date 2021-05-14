<div class="mb-5 mt-5 border p-3">
    <form action="{{ route('post.index') }}" method="GET">
        <div class="mb-3">
            <label class="form-label">Post Name</label>
            <input type="text" class="form-control" value="{{ request()->get('name') }}" name="name" placeholder="post name">
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control">
                <option value=""></option>
                @if(!empty($categories))
                    @foreach ($categories as $categoryId => $categoryName)
                    <option value="{{ $categoryId }}" {{ request()->get('category_id') == $categoryId ? 'selected' : ''  }}>{{ $categoryName }}</option>                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>