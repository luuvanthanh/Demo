@if($errors->any())
    <?php echo implode('', $errors->all('<div>:message</div>')); ?>
@endif

@if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif