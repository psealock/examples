import { registerPlugin } from "@wordpress/plugins";

const { WooNavigationItem } = window.wc;

const MyPlugin = () => {
  return (
    <>
      <WooNavigationItem
        parentMenu="woocommerce"
        item="examples-root"
        title="Examples 😜"
        navigateToMenu="examples-root"
      />
      <WooNavigationItem parentMenu="examples-root" item="example-1">
        <a className="components-button" href="www.example.com/1">
          Example 1 😜
        </a>
      </WooNavigationItem>
    </>
  );
};

registerPlugin("my-plugin", { render: MyPlugin });
