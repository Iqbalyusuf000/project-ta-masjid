<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MemberAvatar extends Component
{
    public $member;
    public $size;
    public $textSize;

    public function __construct(
        $member,
        $size = 'w-24 h-24',
        $textSize = 'text-2xl',
    ) {
        $this->member = $member;
        $this->size = $size;
        $this->textSize = $textSize;
    }

    public function render(): View|Closure|string
    {
        return view('components.member-avatar');
    }
}