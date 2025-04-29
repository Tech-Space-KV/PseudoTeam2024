<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
      wire:poll.30s>
    {{ $unreadCount > 99 ? '99+' : $unreadCount }}
    <span class="visually-hidden">unread messages</span>
</span>
