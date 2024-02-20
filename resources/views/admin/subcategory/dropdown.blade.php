<div>
    <label for="subcategory">Select a subcategory:</label><br>
    <select id="subcategory_id" name="subcategory_id" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white">
        <option value="">Select a subcategory</option>
        @foreach ($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
        @endforeach
    </select>
</div>
