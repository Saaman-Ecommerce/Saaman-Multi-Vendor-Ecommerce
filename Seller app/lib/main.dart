import 'dart:async';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:flutter_localizations/flutter_localizations.dart';
import 'package:provider/provider.dart';
import 'package:Saaman_Vendor/localization/app_localization.dart';
import 'package:Saaman_Vendor/provider/auth_provider.dart';
import 'package:Saaman_Vendor/provider/business_provider.dart';
import 'package:Saaman_Vendor/provider/chat_provider.dart';
import 'package:Saaman_Vendor/provider/delivery_man_provider.dart';
import 'package:Saaman_Vendor/provider/language_provider.dart';
import 'package:Saaman_Vendor/provider/localization_provider.dart';
import 'package:Saaman_Vendor/provider/order_provider.dart';
import 'package:Saaman_Vendor/provider/product_provider.dart';
import 'package:Saaman_Vendor/provider/product_review_provider.dart';
import 'package:Saaman_Vendor/provider/profile_provider.dart';
import 'package:Saaman_Vendor/provider/refund_provider.dart';
import 'package:Saaman_Vendor/provider/restaurant_provider.dart';
import 'package:Saaman_Vendor/provider/shipping_provider.dart';
import 'package:Saaman_Vendor/provider/shop_info_provider.dart';
import 'package:Saaman_Vendor/provider/splash_provider.dart';
import 'package:Saaman_Vendor/provider/theme_provider.dart';
import 'package:Saaman_Vendor/provider/bank_info_provider.dart';
import 'package:Saaman_Vendor/provider/transaction_provider.dart';
import 'package:Saaman_Vendor/theme/dark_theme.dart';
import 'package:Saaman_Vendor/theme/light_theme.dart';
import 'package:Saaman_Vendor/utill/app_constants.dart';
import 'package:Saaman_Vendor/view/screens/splash/splash_screen.dart';

import 'di_container.dart' as di;
import 'notification/my_notification.dart';

final FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin =
    FlutterLocalNotificationsPlugin();

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp();
  await di.init();
  final NotificationAppLaunchDetails notificationAppLaunchDetails =
      await flutterLocalNotificationsPlugin.getNotificationAppLaunchDetails();
  if (notificationAppLaunchDetails?.didNotificationLaunchApp ?? false) {
  }
  await MyNotification.initialize(flutterLocalNotificationsPlugin);
  FirebaseMessaging.onBackgroundMessage(myBackgroundMessageHandler);

  runApp(MultiProvider(
    providers: [
      ChangeNotifierProvider(create: (context) => di.sl<ThemeProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<SplashProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<LanguageProvider>()),
      ChangeNotifierProvider(
          create: (context) => di.sl<LocalizationProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<AuthProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<ProfileProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<ShopProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<OrderProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<BankInfoProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<ChatProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<BusinessProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<TransactionProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<RestaurantProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<ProductProvider>()),
      ChangeNotifierProvider(
          create: (context) => di.sl<ProductReviewProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<ShippingProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<DeliveryManProvider>()),
      ChangeNotifierProvider(create: (context) => di.sl<RefundProvider>()),
    ],
    child: MyApp(),
  ));
}

class MyApp extends StatelessWidget {
  static final navigatorKey = new GlobalKey<NavigatorState>();

  @override
  Widget build(BuildContext context) {
    List<Locale> _locals = [];
    AppConstants.languages.forEach((language) {
      _locals.add(Locale(language.languageCode, language.countryCode));
    });
    return MaterialApp(
      title: 'SAAMAN VENDOR',
      debugShowCheckedModeBanner: false,
      navigatorKey: navigatorKey,
      theme: Provider.of<ThemeProvider>(context).darkTheme ? dark : light,
      locale: Provider.of<LocalizationProvider>(context).locale,
      localizationsDelegates: [
        AppLocalization.delegate,
        GlobalMaterialLocalizations.delegate,
        GlobalWidgetsLocalizations.delegate,
        GlobalCupertinoLocalizations.delegate,
      ],
      supportedLocales: _locals,
      home: SplashScreen(),
    );
  }
}
