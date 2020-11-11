import Vue from "vue";
import {
  Pagination,
  Input,
  InputNumber,
  Select,
  Option,
  OptionGroup,
  Button,
  Table,
  TableColumn,
  Tooltip,
  Form,
  FormItem,
  Slider,
  Row,
  Col,
  Container,
  Header,
  Aside,
  Main,
  Footer,
  PageHeader,
  Loading,
  Notification
} from "element-ui";
import lang from "element-ui/lib/locale/lang/ru-RU";
import locale from "element-ui/lib/locale";

locale.use(lang);

Vue.use(Pagination);
Vue.use(Input);
Vue.use(InputNumber);
Vue.use(Select);
Vue.use(Option);
Vue.use(OptionGroup);
Vue.use(Button);
Vue.use(Table);
Vue.use(TableColumn);
Vue.use(Tooltip);
Vue.use(Form);
Vue.use(FormItem);
Vue.use(Slider);
Vue.use(Row);
Vue.use(Col);
Vue.use(Container);
Vue.use(Header);
Vue.use(Aside);
Vue.use(Main);
Vue.use(Footer);
Vue.use(PageHeader);

Vue.use(Loading.directive);

Vue.prototype.$notify = Notification;
