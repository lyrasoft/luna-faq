import u from '@main';

u.$ui.bootstrap.tooltip();

const formId = '#admin-form';

u.formValidation()
  .then(() => u.$ui.disableOnSubmit(formId));
u.form(formId).initComponent();
u.$ui.keepAlive(location.href);
