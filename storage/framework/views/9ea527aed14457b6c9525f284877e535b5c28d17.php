<html>
	<head>
		<title>Mail Of ...</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
	</head>
	<body>
		<h4>New Invoice has been Made By <span class="label label-success"><?php echo e($invoice->user->username); ?></span> at <small><?php echo e($invoice->created_at->toDayDateTimeString()); ?></small></h4>
	</body>
</html>