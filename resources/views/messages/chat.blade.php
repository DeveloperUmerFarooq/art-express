@extends('layouts.' . auth()->user()->getRoleNames()->first() . 'Layout.layout')

@section('page')
<div class="container-fluid mt-2">
    <div class="bg-transparent shadow-lg rounded" style="height: 100vh; display: flex; flex-direction: column;">
        <!-- Chat Header -->
        <div class="bg-success text-white p-3 d-flex justify-content-between align-items-center rounded-top shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset($reciever->avatar) }}" height="45" class="rounded-circle border border-light p-1" alt="Profile Image" style="transition: transform 0.3s;">

                <div class="d-flex flex-column">
                    <h5 class="mb-0 text-light">{{ $reciever->name }}</h5>
                    <small class="text-light" style="font-size: 0.85rem;">Online</small>
                </div>
            </div>

            <button class="btn btn-light btn-sm shadow-sm" style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#f1f1f1'" onmouseout="this.style.backgroundColor=''">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-ccw"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
            </button>
        </div>


        <!-- Chat Messages Area -->
        <div class="p-3 flex-grow-1" id="chat-box" style="overflow-y: auto; flex-grow: 1; max-height: calc(100vh - 100px);">
            <!-- Dummy Messages -->
            <div class="d-flex justify-content-start mb-2">
                <div class="bg-light p-3 rounded shadow-sm" style="max-width: 75%;">
                    <strong>John Doe</strong>
                    <p class="mb-0">Hello! How are you?</p>
                    <small class="text-muted">2 mins ago</small>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-2">
                <div class="bg-success text-white p-3 rounded shadow-sm" style="max-width: 75%;">
                    <strong>You</strong>
                    <p class="mb-0">I'm good! What about you?</p>
                    <small><small class="text-muted">Just now</small></small>
                </div>
            </div>
        </div>

        <!-- Chat Input Area (Form at Bottom) -->
        <div class="bg-light p-3 rounded-bottom">
            <form id="chat-form" class="d-flex gap-1 align-items-center">
                <input type="hidden" name="reciever_id" value="{{$reciever->id}}">
                <input type="hidden" name="sender_id" value="{{auth()->user()->id}}">
                <input type="file" id="image-input" class="form-control mr-2" style="display:none" accept="image/*">
                <abbr title="Choose a file" style="cursor: pointer">
                    <span class="me-2 border border-1 p-2" onclick="document.getElementById('image-input').click();"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg></span>
                </abbr>
                <input type="text" id="message" class="form-control" placeholder="Type a message..." required>
                <button class="btn btn-primary ml-2" type="submit">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to latest message

    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();

        let message = document.getElementById('message').value;
        let imageInput = document.getElementById('image-input').files[0];

        if (!message.trim() && !imageInput) return;

        // Display message
        if (message.trim()) {
            chatBox.innerHTML += `
                <div class="d-flex justify-content-end mb-2">
                    <div class="bg-success text-white p-3 rounded shadow-sm" style="max-width: 75%;">
                        <strong>You</strong>
                        <p class="mb-0">${message}</p>
                        <small class="text-muted">Just now</small>
                    </div>
                </div>`;
        }

        // Display image (if uploaded)
        if (imageInput) {
            let reader = new FileReader();
            reader.onload = function (e) {
                chatBox.innerHTML += `
                    <div class="d-flex justify-content-end mb-2">
                        <div class="bg-success text-white p-3 rounded shadow-sm" style="max-width: 75%;">
                            <strong>You</strong>
                            <img src="${e.target.result}" class="img-fluid" style="max-width: 200px;" />
                            <small class="text-muted">Just now</small>
                        </div>
                    </div>`;
            };
            reader.readAsDataURL(imageInput);
        }

        document.getElementById('message').value = '';
        document.getElementById('image-input').value = ''; // Reset file input
        chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
    });
});
</script>
@endpush
