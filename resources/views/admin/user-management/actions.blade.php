<div class="d-flex gap-1 gap-md-2">
    <abbr title="Edit">
        <a href="#" data-bs-toggle="modal" data-bs-target="#Edit-Form" onclick="editUser({{$user}})">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:20px; height: auto;" viewBox="0 0 24 24" fill="none" stroke="#131010" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-pen-line"><path d="m18 5-2.414-2.414A2 2 0 0 0 14.172 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2"/><path d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><path d="M8 18h1"/></svg>
        </a>
    </abbr>
    <abbr title="Delete">
        <span style="cursor: pointer" id="Delete" onclick="deleteUser('{{route('admin.management.user.delete',$id)}}')">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:20px; height: auto;" viewBox="0 0 24 24" fill="none" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
        </span>
    </abbr>
</div>
