import Vue from 'vue';
import { ValidationProvider, ValidationObserver, configure, extend } from 'vee-validate';
import { required, min, max, between, email, numeric, confirmed } from 'vee-validate/dist/rules';

Vue.component('validation-observer', ValidationObserver);
Vue.component('validation-provider', ValidationProvider);

// If any option you want to change common
configure({ bails: false });

// Continue to add the necessary rule
extend('min', {
  ...min,
  message: 'Phải lớn hơn {length} ký tự.'
});
extend('max', {
  ...max,
  message: 'Phải nhỏ hơn {length} ký tự.'
});
extend('required', {
  ...required,
  message: 'Không được để trống.'
});
extend('between', {
  ...between,
  params: ['min', 'max'],
  message: 'Phải nằm trong khoảng {min} - {max} ký tự.'
});
extend('email', {
  ...email,
  message: 'Email không hợp lệ.'
});
extend('numeric', {
  ...numeric,
  message: 'Phải là số.'
});
extend('confirmed', {
  ...confirmed,
  message: 'Không trùng khớp.'
});
extend('phone', {
  message: 'Số điện thoại không hợp lệ.',
  validate: (value) => {
    return /(02|03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/.test(value);
  }
});
extend('password', {
  message: 'Mật khẩu bao gồm 8-16 ký tự, có ít nhất 1 ký tự viết hoa, 1 ký tự viết thường, 1 ký tự đặc biệt',
  validate: (value) => {
    return /(?=^.{8,16}$)((?=.\d)(?=.\W+))(?![.\n])(?=.[A-Z])(?=.[a-z]).*$/.test(value);
  }
});