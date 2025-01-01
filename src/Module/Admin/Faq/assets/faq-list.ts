import u from '@main';

u.$ui.bootstrap.tooltip();

const formId = '#admin-form';

u.grid(formId).initComponent();
u.$ui.disableOnSubmit(formId);
u.$ui.checkboxesMultiSelect(formId);
