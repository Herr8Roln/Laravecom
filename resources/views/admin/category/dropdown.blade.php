<div>
    <label for="category">Select a category:</label>
    </br>
    <select id="category_id" name="category_id" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white">
        @foreach ($category as $category)

            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
