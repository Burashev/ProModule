<div class="filter-group">
    <label>{{$filter->title()}}</label>
    <div class="filter-group__body">
        <select multiple name="{{$filter->name()}}[]" id="skill_filter">
            @foreach($filter->values() as $id => $title)
                <option value="{{$id}}" @selected($filter->multipleSelectSelected($id))>{{$title}}</option>
            @endforeach
        </select>
    </div>
</div>

<script type="text/javascript">
    $("#skill_filter").select2({
        width: '100%',
        placeholder: "Выберите компетенции",
        allowClear: true
    });
</script>
