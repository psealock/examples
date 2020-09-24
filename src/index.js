import { registerPlugin } from "@wordpress/plugins";

const {
  WooNavigationMenu,
  WooNavigationItem,
  RawItem: NavigationItem,
} = window.wc;

const MyPlugin = () => {
  return (
    <>
      <WooNavigationItem
        menu="woocommerce"
        item="example-1"
        title="Examples"
        navigateToMenu="my-plugin-examples"
      />
      <WooNavigationMenu menu="my-plugin-examples" parentMenu="woocommerce">
        <NavigationItem item="example-1">
          <a className="components-button" href="www.example.com/1">
            Example 1
          </a>
        </NavigationItem>
        <NavigationItem item="example-2">
          <a className="components-button" href="www.example.com/2">
            Example 2
          </a>
        </NavigationItem>
      </WooNavigationMenu>
    </>
  );
};

registerPlugin("my-plugin", { render: MyPlugin });
