import { registerPlugin } from "@wordpress/plugins";

const { WooNavigationMenu, WooNavigationItem } = window.wc;

const MyPlugin = () => {
  return (
    <WooNavigationItem
      menu="woocommerce"
      item="example-1"
      title="Examples"
      navigateToMenu="my-plugin-examples"
    />
  );
};

registerPlugin("my-plugin", { render: MyPlugin });

// return (
//   <>
//     <WooNavigationMenu menu="woocommerce">
//       <WooNavigationItem
// item="example-1"
// title="Examples"
// navigateToMenu="my-plugin-examples"
//       />
//     </WooNavigationMenu>
//     <WooNavigationMenu menu="my-plugin-examples" parentMenu="woocommerce">
//       <WooNavigationItem item="example-1">
//         <a className="components-button" href="www.example.com/1">
//           Example 1
//         </a>
//       </WooNavigationItem>
//       <WooNavigationItem item="example-2">
//         <a className="components-button" href="www.example.com/2">
//           Example 2
//         </a>
//       </WooNavigationItem>
//     </WooNavigationMenu>
//   </>
// );
