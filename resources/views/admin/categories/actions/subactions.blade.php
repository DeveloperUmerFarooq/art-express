<div class="d-flex gap-1 gap-md-2">
    <abbr title="Edit">
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="editSub({{$category}})">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </abbr>
    <abbr title="Delete">
        <span style="cursor: pointer" id="Delete" onclick="deleteSub('{{route('admin.management.catergory.sub.delete',$id)}}')">
            <i class="fa-solid fa-trash text-danger"></i>
        </span>
    </abbr>
</div>
