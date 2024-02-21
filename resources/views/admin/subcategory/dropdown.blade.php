<div>
    <label for="subcategory">Select a subcategory:</label><br>
    <select id="subcategory_id" name="subcategory_id" class="form-control">
        <option value="" >Select a subcategory</option>
        @foreach ($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
        @endforeach
    </select>
</div>
