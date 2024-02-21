<div>
    <label for="category">Select a category:</label>
    </br>
    <select name="category_id" id="category_id" class="form-control">
        @foreach ($category as $category)

            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
