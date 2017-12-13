<style>
    .YoutubeVideoCreated .activity-media > div {
        margin-top: 5px;
        margin-bottom: 5px;
        padding-bottom: 56.25%; /* 16:9 */
        padding-top: 25px;
        height: 0 !important;
        width: 100% !important;
    }

    .YoutubeVideoCreated .activity-media iframe {
        width: 100% !important;
        height: 100% !important;
    }

    .row.activity {
        padding-top: 5px;
        padding-bottom: 5px;
        border-bottom: 1px solid #ccc;
    }

    .uiScrollableArea {
        height: 100%;
        overflow: hidden;
        position: relative;
    }

    .uiScrollableAreaWrap {
        /* sneaky hide scrollbars */
        margin-right: -30px;
        padding-right: 30px;
        height: 100%;
        outline: none;
        overflow-x: hidden;
        position: relative;
    }

    .uiScrollableArea .uiScrollableAreaWrap {
        overflow-y: scroll;
    }

    .uiScrollableAreaBody {
        position: relative;
    }

    .uiScrollableAreaContent {

    }
</style>
<div class="uiScrollableArea" style="height: 50%;padding-bottom:30px">
    <div class="uiScrollableAreaWrap">
        <div class="uiScrollableAreaBody">
            <div class="uiScrollableAreaContent" data-ui="scrollable">
                <article class="row activities">
                    <header class="col-lg-12"></header>
                    <div class="col-md-12">
                        @foreach($activities as $activity)
                            <div class="row activity {{ class_basename($activity) }}">
                                {!! $activity->view !!}
                            </div>
                        @endforeach
                    </div>
                    <footer class="col-md-12"></footer>
                </article>
            </div>
        </div>
    </div>
</div>