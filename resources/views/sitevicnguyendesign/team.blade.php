@extends('sitevicnguyendesign.layout.maindesign')
@section('title','team')

@section('content')
<section id="main" class="news_detail">
    <div class="block_team">
        <div class="container">
            <div class="content">
                <ul>
                    @forelse ($members as $member)
                        <li>
                            <div class="team">
                                <div class="img_team"
                                        style="background-image: url('{{ asset('storage/' . $member->image) }}');">
                                </div>
                                <div class="infor_team">
                                    <h5>
                                        <strong>{{ $member->name }}</strong>
                                    </h5>
                                    <p>
                                        {{ $member->main_role }}
                                        <span>&nbsp;</span>
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </li>
                    @empty
                        <li>
                            <p>Hiện chưa có thành viên nào.</p>
                        </li>
                    @endforelse
                    <div class="clear"></div>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
