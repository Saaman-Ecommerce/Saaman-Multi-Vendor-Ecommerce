import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:Saaman_Vendor/helper/price_converter.dart';
import 'package:Saaman_Vendor/localization/language_constrants.dart';
import 'package:Saaman_Vendor/provider/bank_info_provider.dart';
import 'package:Saaman_Vendor/provider/order_provider.dart';
import 'package:Saaman_Vendor/provider/product_provider.dart';
import 'package:Saaman_Vendor/provider/profile_provider.dart';
import 'package:Saaman_Vendor/provider/shipping_provider.dart';
import 'package:Saaman_Vendor/provider/splash_provider.dart';
import 'package:Saaman_Vendor/provider/transaction_provider.dart';
import 'package:Saaman_Vendor/utill/color_resources.dart';
import 'package:Saaman_Vendor/utill/dimensions.dart';
import 'package:Saaman_Vendor/utill/images.dart';
import 'package:Saaman_Vendor/utill/styles.dart';
import 'package:Saaman_Vendor/view/screens/home/widget/order_type_button.dart';
import 'package:Saaman_Vendor/view/screens/home/widget/order_type_button_head.dart';
import 'package:Saaman_Vendor/view/screens/home/widget/stock_out_product_widget.dart';
import 'package:Saaman_Vendor/view/screens/home/widget/transaction_chart.dart';

class HomePageScreen extends StatefulWidget {
  final Function callback;
  const HomePageScreen({Key key, this.callback}) : super(key: key);

  @override
  State<HomePageScreen> createState() => _HomePageScreenState();
}

class _HomePageScreenState extends State<HomePageScreen> {
  final ScrollController _scrollController = ScrollController();
  Future<void> _loadData(BuildContext context, bool reload) async {
    Provider.of<ProfileProvider>(context, listen: false).getSellerInfo(context);
    Provider.of<BankInfoProvider>(context, listen: false)
        .getUserEarnings(context);
    Provider.of<BankInfoProvider>(context, listen: false)
        .getUserCommissions(context);
    Provider.of<BankInfoProvider>(context, listen: false).getBankInfo(context);
    Provider.of<OrderProvider>(context, listen: false).getOrderList(context);
    Provider.of<SplashProvider>(context, listen: false).getColorList();
    Provider.of<ProductProvider>(context, listen: false)
        .getStockOutProductList(1, context, 'en');
    Provider.of<ShippingProvider>(context, listen: false)
        .getCategoryWiseShippingMethod(context);
    Provider.of<ShippingProvider>(context, listen: false)
        .getSelectedShippingMethodType(context);
    Provider.of<TransactionProvider>(context, listen: false)
        .getTransactionList(context);
    Provider.of<ProductProvider>(context, listen: false).initSellerProductList(
        Provider.of<ProfileProvider>(context, listen: false)
            .userInfoModel
            .id
            .toString(),
        1,
        context,
        'en',
        reload: true);
  }

  @override
  void initState() {
    _loadData(context, false);
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: ColorResources.getHomeBg(context),
      body: Consumer<OrderProvider>(
        builder: (context, order, child) {
          return order.orderList != null
              ? SafeArea(
                  child: RefreshIndicator(
                    onRefresh: () async {
                      await _loadData(context, true);
                    },
                    backgroundColor: Theme.of(context).primaryColor,
                    child: CustomScrollView(
                      controller: _scrollController,
                      slivers: [
                        SliverAppBar(
                          floating: true,
                          elevation: 0,
                          centerTitle: false,
                          automaticallyImplyLeading: false,
                          backgroundColor: Theme.of(context).highlightColor,
                          title: Image.asset(Images.logo_with_app_name,
                              height: 35),
                        ),
                        SliverToBoxAdapter(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              SizedBox(height: Dimensions.PADDING_SIZE_SMALL),
                              Container(
                                padding: EdgeInsets.only(
                                    top: Dimensions.PADDING_SIZE_SMALL),
                                decoration: BoxDecoration(
                                  color: Theme.of(context).cardColor,
                                  boxShadow: [
                                    BoxShadow(
                                        color:
                                            ColorResources.getPrimary(context)
                                                .withOpacity(.05),
                                        spreadRadius: -3,
                                        blurRadius: 12,
                                        offset: Offset.fromDirection(0, 6))
                                  ],
                                ),
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Padding(
                                      padding: const EdgeInsets.symmetric(
                                          horizontal:
                                              Dimensions.PADDING_SIZE_DEFAULT,
                                          vertical:
                                              Dimensions.PADDING_SIZE_SMALL),
                                      child: Text(
                                        getTranslated(
                                            'on_going_orders', context),
                                        style: robotoBold.copyWith(
                                            color:
                                                Theme.of(context).primaryColor),
                                      ),
                                    ),
                                    order.pendingList != null
                                        ? Consumer<OrderProvider>(
                                            builder: (context, orderProvider,
                                                    child) =>
                                                Padding(
                                              padding: const EdgeInsets.all(
                                                  Dimensions
                                                      .PADDING_SIZE_SMALL),
                                              child: GridView.count(
                                                physics:
                                                    NeverScrollableScrollPhysics(),
                                                crossAxisCount: 2,
                                                childAspectRatio: (1 / .65),
                                                shrinkWrap: true,
                                                children: [
                                                  OrderTypeButtonHead(
                                                    color: ColorResources
                                                        .mainCardOneColor(
                                                            context),
                                                    text: getTranslated(
                                                        'pending', context),
                                                    index: 1,
                                                    subText: getTranslated(
                                                        'orders', context),
                                                    orderList: orderProvider
                                                        .pendingList,
                                                    callback: widget.callback,
                                                  ),
                                                  OrderTypeButtonHead(
                                                    color: ColorResources
                                                        .mainCardTwoColor(
                                                            context),
                                                    text: getTranslated(
                                                        'processing', context),
                                                    index: 2,
                                                    orderList: orderProvider
                                                        .processing,
                                                    callback: widget.callback,
                                                    subText: getTranslated(
                                                        'orders', context),
                                                  ),
                                                  OrderTypeButtonHead(
                                                    color: ColorResources
                                                        .mainCardThreeColor(
                                                            context),
                                                    text: getTranslated(
                                                        'confirmed', context),
                                                    index: 7,
                                                    subText: getTranslated(
                                                        'orders', context),
                                                    orderList: orderProvider
                                                        .confirmedList,
                                                    callback: widget.callback,
                                                  ),
                                                  OrderTypeButtonHead(
                                                    color: ColorResources
                                                        .mainCardFourColor(
                                                            context),
                                                    text: getTranslated(
                                                        'out_for_delivery',
                                                        context),
                                                    index: 8,
                                                    subText: '',
                                                    orderList: orderProvider
                                                        .outForDeliveryList,
                                                    callback: widget.callback,
                                                  ),
                                                ],
                                              ),
                                            ),
                                          )
                                        : SizedBox(
                                            height: 150,
                                            child: Center(
                                                child: CircularProgressIndicator(
                                                    valueColor:
                                                        AlwaysStoppedAnimation(
                                                            Theme.of(context)
                                                                .primaryColor)))),
                                    SizedBox(
                                        height: Dimensions.PADDING_SIZE_SMALL),
                                  ],
                                ),
                              ),
                              SizedBox(height: Dimensions.PADDING_SIZE_SMALL),
                              Container(
                                decoration: BoxDecoration(
                                  color: Theme.of(context).cardColor,
                                  boxShadow: [
                                    BoxShadow(
                                        color:
                                            ColorResources.getPrimary(context)
                                                .withOpacity(.05),
                                        spreadRadius: -3,
                                        blurRadius: 12,
                                        offset: Offset.fromDirection(0, 6))
                                  ],
                                ),
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Padding(
                                      padding: const EdgeInsets.symmetric(
                                          horizontal:
                                              Dimensions.PADDING_SIZE_DEFAULT,
                                          vertical:
                                              Dimensions.PADDING_SIZE_DEFAULT),
                                      child: Text(
                                        getTranslated(
                                            'completed_orders', context),
                                        style: robotoBold.copyWith(
                                            color:
                                                Theme.of(context).primaryColor),
                                      ),
                                    ),
                                    order.pendingList != null
                                        ? Consumer<OrderProvider>(
                                            builder: (context, orderProvider,
                                                    child) =>
                                                SizedBox(
                                              child: ListView(
                                                shrinkWrap: true,
                                                physics:
                                                    NeverScrollableScrollPhysics(),
                                                children: [
                                                  OrderTypeButton(
                                                    color: ColorResources
                                                        .mainCardThreeColor(
                                                            context),
                                                    icon: Images.delivered,
                                                    text: getTranslated(
                                                        'delivered', context),
                                                    index: 3,
                                                    orderList: orderProvider
                                                        .deliveredList,
                                                    callback: widget.callback,
                                                  ),
                                                  OrderTypeButton(
                                                    color: ColorResources
                                                        .mainCardFourColor(
                                                            context),
                                                    icon: Images.cancelled,
                                                    text: getTranslated(
                                                        'cancelled', context),
                                                    index: 6,
                                                    orderList: orderProvider
                                                        .canceledList,
                                                    callback: widget.callback,
                                                  ),
                                                  OrderTypeButton(
                                                    color: ColorResources
                                                        .getTextColor(context),
                                                    icon: Images.returned,
                                                    text: getTranslated(
                                                        'return', context),
                                                    index: 4,
                                                    orderList: orderProvider
                                                        .returnList,
                                                    callback: widget.callback,
                                                  ),
                                                  OrderTypeButton(
                                                    color: ColorResources
                                                        .mainCardFourColor(
                                                            context),
                                                    icon: Images.failed,
                                                    text: getTranslated(
                                                        'failed', context),
                                                    index: 5,
                                                    orderList: orderProvider
                                                        .failedList,
                                                    callback: widget.callback,
                                                  ),
                                                ],
                                              ),
                                            ),
                                          )
                                        : SizedBox(
                                            height: 150,
                                            child: Center(
                                                child: CircularProgressIndicator(
                                                    valueColor:
                                                        AlwaysStoppedAnimation(
                                                            Theme.of(context)
                                                                .primaryColor)))),
                                    SizedBox(
                                        height:
                                            Dimensions.PADDING_SIZE_DEFAULT),
                                  ],
                                ),
                              ),
                              SizedBox(height: Dimensions.PADDING_SIZE_SMALL),
                              Container(
                                  decoration: BoxDecoration(
                                    color: Theme.of(context).cardColor,
                                    boxShadow: [
                                      BoxShadow(
                                          color:
                                              ColorResources.getPrimary(context)
                                                  .withOpacity(.05),
                                          spreadRadius: -3,
                                          blurRadius: 12,
                                          offset: Offset.fromDirection(0, 6))
                                    ],
                                  ),
                                  child: StockOutProductView(
                                      scrollController: _scrollController,
                                      isHome: true)),
                              SizedBox(height: Dimensions.PADDING_SIZE_SMALL),
                              Container(
                                decoration: BoxDecoration(
                                  color: Theme.of(context).cardColor,
                                  boxShadow: [
                                    BoxShadow(
                                        color:
                                            ColorResources.getPrimary(context)
                                                .withOpacity(.05),
                                        spreadRadius: -3,
                                        blurRadius: 12,
                                        offset: Offset.fromDirection(0, 6))
                                  ],
                                ),

                              ),
                            ],
                          ),
                        )
                      ],
                    ),
                  ),
                )
              : Center(
                  child: CircularProgressIndicator(
                      valueColor: AlwaysStoppedAnimation(
                          Theme.of(context).primaryColor)));
        },
      ),
    );
  }
}
