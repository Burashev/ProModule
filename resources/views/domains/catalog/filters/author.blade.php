<div class="filter-group">
    <label>{{$filter->title()}}</label>
    <div class="filter-group__body">
        <select multiple name="{{$filter->name()}}[]" id="author_filter">
            @foreach($filter->values() as $id => $name)
                <option value="{{$id}}" @selected($filter->multipleSelectSelected($id))>{{$name}}</option>
            @endforeach
        </select>
    </div>
</div>

<script type="text/javascript">
    $("#author_filter").select2({
        width: '100%',
        placeholder: "Выберите автора",
        allowClear: true
    });
</script>
