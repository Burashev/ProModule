@foreach($filter->values() as $tagType)
    <div class="filter-group">
        <label>{{$tagType->title}}</label>
        <div class="filter-group__body">
            <select multiple name="{{$filter->name()}}[{{$tagType->name}}][]" id="tag_{{$tagType->name}}_filter">
                @foreach($tagType->tags as $tag)
                    <option value="{{$tag->id}}" @selected($filter->multipleSelectSelected($tag->id, $tagType->name))>{{$tag->title}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <script type="text/javascript">
        $("#tag_{{$tagType->name}}_filter").select2({
            width: '100%',
            placeholder: "Выберите {{$tagType->title}}",
            allowClear: true
        });
    </script>
@endforeach


