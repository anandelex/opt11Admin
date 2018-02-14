customClassFormValidation();
function customClassFormValidation() {
	jQuery.validator.addClassRules({
		requiredItem	:	{ required		: true },
		validEmail		:	{ email			: true },
		validUrl		:	{ url			: true },
		validNumber		:	{ number		: true },
		validLetter		:	{ lettersonly	: true },
		validAlphaNum	:	{ alphanumeric	: true },
		validInt		:	{ digits		: true },
		validDate		:	{ date			: true },
		validDateITA	:	{ dateITA		: true },
		validDateISO	:	{ dateISO		: true },
		validTime		:	{ time			: true },
		mmddyyyy		:	{ mmddyyyy		: true },
		noFutureDate	:	{ noFutureDate	: true }
	});
}
function injectTrim(handler) {
	return function (element, event) {
		if (element.tagName === "TEXTAREA" || (element.tagName === "INPUT" && element.type !== "password")) {
			element.value = $.trim(element.value);
		}
		return handler.call(this, element, event);
	};
}
function successGrowl(msg){
	$.bootstrapGrowl(msg, { type: 'success' });//Add ", allow_dismiss: false" after "{ type: 'success' }" incase u neeed remove X symbol
};
function infoGrowl(msg){
	$.bootstrapGrowl(msg, { type: 'info' });
};
function warningGrowl(msg){
	$.bootstrapGrowl(msg, { type: 'warning' });
};
function errorGrowl(msg){
	$.bootstrapGrowl(msg, { type: 'danger' });
};